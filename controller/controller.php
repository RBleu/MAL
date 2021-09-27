<?php

require_once('model/AnimeManager.php');
require_once('model/UserManager.php');

$isConnected = false;

function print_a($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function formatDate($format, $date)
{
    return date($format, strtotime($date));
}

function getCurrentSeason()
{
    $seasons = ['Winter ', 'Spring ', 'Summer ', 'Fall '];

    return $seasons[ceil(date('n')/3) - 1].date('Y');
}

function getPrevNextSeasons($season)
{
    $seasons = ['Winter', 'Spring', 'Summer', 'Fall'];

    $split = explode(' ', $season);

    $iCurrent = array_search($split[0], $seasons);
    $currentYear = (int)$split[1];

    $iPrev = $iCurrent - 1;
    $prevYear = ($iPrev < 0)? $currentYear - 1 : $currentYear;
    $prevSeason = $seasons[(4 + $iPrev)%4].' '.$prevYear;

    $iNext = $iCurrent + 1;
    $nextYear = ($iNext > 3)? $currentYear + 1 : $currentYear;
    $nextSeason = $seasons[$iNext%4].' '.$nextYear;

    $iNextNext = $iNext + 1;
    $nextNextYear = ($iNextNext > 3)? $currentYear + 1 : $currentYear;
    $nextNextSeason = $seasons[$iNextNext%4].' '.$nextNextYear;

    return [$prevSeason, $season, $nextSeason, $nextNextSeason];
}

function checkCookies()
{
    global $isConnected;

    if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
    {
        $userManager = new UserManager();
        $isConnected = $userManager->check($_COOKIE['username'], $_COOKIE['password']);

        if(!$isConnected)
        {
            header('Location: index.php?a=logout');
        }
    }
}

function displayIndex()
{
    global $isConnected;

    $animeManager = new AnimeManager();

    $currentSeason       = getCurrentSeason();
    $currentSeasonAnimes = $animeManager->getAnimesBySeason($currentSeason);

    $topAnimes = [];
    $topAnimes['Top Airing Anime']   = $animeManager->getTopAnimes('score', 5, 'airing = 1');
    $topAnimes['Top Upcoming Anime'] = $animeManager->getTopAnimes('members', 5, 'status = "Not yet aired"');
    $topAnimes['Most Popular Anime'] = $animeManager->getTopAnimes('members', 10);

    if($isConnected)
    {
        $userManager = new UserManager();
        $stats       = $userManager->getProfileStats($_COOKIE['username']);
    }

    require('view/indexView.php');
}

function displayAnime($id)
{
    global $isConnected;

    $animeManager = new AnimeManager();

    $anime     = $animeManager->getAnimeById($id);
    $genres    = $animeManager->getAnimeGenres($id);

    $relations = $animeManager->getAnimeRelations($id);
    $prequels  = $relations['prequels'];
    $sequels   = $relations['sequels'];

    $themes    = $animeManager->getAnimeThemes($id);

    require('view/animeView.php');
}

function loginUser($username, $password)
{
    global $isConnected;

    if(!preg_match('/^[\w]{4,20}$/', $username) || !preg_match('/^.{8,50}$/', $password))
    {
        $errorMessage = 'Username and/or password not valid';
        require('view/loginView.php');
        return;
    }

    $userManager = new UserManager();

    $hash = $userManager->getPasswordHash($username);

    if(!$hash || !password_verify($password, $hash['password']))
    {
        $errorMessage = 'Wrong username and/or wrong password';
        require('view/loginView.php');
        return;
    }

    setcookie('username', $username, time() + 7*24*3600, null, null, false, true);
    setcookie('password', $hash['password'], time() + 7*24*3600, null, null, false, true);

    header('Location: ./');
}

function searchAnimesByTitleJs($title)
{
    $animeManager = new AnimeManager();

    $animes = $animeManager->getAnimesByTitleJs($title);

    echo json_encode($animes);
}

function getAnimesGenres($animeManager, $animes)
{
    $genres = [];

    foreach($animes as $anime)
    {
        $genres[$anime['id']] = $animeManager->getAnimeGenres($anime['id']);
    }

    return $genres;
}

function searchAnimesByTitle($title)
{
    global $isConnected;

    $animeManager = new AnimeManager();

    $animes = $animeManager->getAnimesByTitle($title);
    $genres = getAnimesGenres($animeManager, $animes);

    $pageTitle   = 'Search - MAL';
    $headerTitle = 'Search';    

    require('view/searchTemplate.php');
}

function searchAnimesBySeason($season)
{
    global $isConnected;

    $animeManager  = new AnimeManager();
    $currentSeason = getCurrentSeason();

    if(!preg_match('/(Winter|Spring|Summer|Fall) [0-9]{4}/', $season))
    {
        header('Location: index.php?a=search&season='.urlencode($currentSeason));
        return;
    }

    $animes = $animeManager->getAnimesBySeason($season);
    $genres = getAnimesGenres($animeManager, $animes);
    
    $seasons = getPrevNextSeasons($season);

    require('view/seasonView.php');
}

function searchAnimesByGenre($genreId)
{
    global $isConnected;

    $animeManager = new AnimeManager();

    $genre = $animeManager->getGenreById($genreId);

    if(!$genre)
    {
        throw new Exception('Genre not found');
    }

    $animes = $animeManager->getAnimesByGenre($genreId);
    $genres = getAnimesGenres($animeManager, $animes);

    $pageTitle   = $genre['genre'].' - MAL';
    $headerTitle = $genre['genre'].' Anime';
    
    require('view/searchTemplate.php');
}

function displayProfile($username)
{
    global $isConnected;

    $userManager = new UserManager();

    $profile = $userManager->getProfileByUsername($username);
    $stats = $userManager->getProfileStats($username);
    $totalAnimes = array_sum($stats);
    $history = $userManager->getProfileHistory($username);
    $totalEpisodes = $userManager->getProfileTotalEpisodes($username);

    require('view/profileView.php');
}

function displayAnimeList($username, $listId = 2)
{
    $userManager = new UserManager();

    $animelist = $userManager->getAnimeList($username, $listId);
    $lists     = $userManager->getAllLists();

    require('view/animelistView.php');
}

function signUpUser($email, $username, $password, $confirmPassword)
{
    $userManager = new UserManager();

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errorMessage = 'Email not valid';
        require('view/signupView.php');
        return;
    }

    if($userManager->emailExists($email))
    {
        $errorMessage = 'Email already used';
        require('view/signupView.php');
        return;
    }

    if(!preg_match('/^[\w]{4,20}$/', $username))
    {
        $errorMessage = 'Username not valid';
        require('view/signupView.php');
        return;
    }

    if($userManager->exists($username))
    {
        $errorMessage = 'Username already used';
        require('view/signupView.php');
        return;
    }

    if($password != $confirmPassword)
    {
        $errorMessage = 'Passwords not equals';
        require('view/signupView.php');
        return;
    }

    if(!preg_match('/^.{8,50}$/', $password))
    {
        $errorMessage = 'Password not valid';
        require('view/signupView.php');
        return;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $res = $userManager->createUser($email, $username, $hash);

    if($res === true)
    {
        setcookie('username', $username, time() + 7*24*3600, null, null, false, true);
        setcookie('password', $hash, time() + 7*24*3600, null, null, false, true);

        header('Location: ./');
        return;
    }
    else
    {
        throw new Exception($res);
    }
}