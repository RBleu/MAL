<?php

require_once('model/AnimeManager.php');
require_once('model/UserManager.php');

$isConnected = false;

function print_a($arr)
{
    echo '<pre>';
    print_r($arr);
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

function getSeasons($season)
{
    $seasons = ['Winter ', 'Spring ', 'Summer ', 'Fall '];

    $split = explode(' ', $season);

    $iCurrent = array_search($split[0], $seasons);
    $currentYear = (int)$split[1];

    $iPrev = $iCurrent - 1;
    $prevYear = ($iPrev < 0)? $currentYear - 1 : $currentYear;
    $prevSeason = $seasons[(4 + $iPrev)%4].$prevYear;

    $iNext = $iCurrent + 1;
    $nextYear = ($iNext > 3)? $currentYear + 1 : $currentYear;
    $nextSeason = $seasons[$iNext%4].$nextYear;

    $iNextNext = $iNext + 1;
    $nextNextYear = ($iNextNext > 3)? $currentYear + 1 : $currentYear;
    $nextNextSeason = $seasons[$iNextNext%4].$nextNextYear;

    return [$prevSeason, $season, $nextSeason, $nextNextSeason];
}

function displayAnime($id)
{
    global $isConnected;
    $animeManager = new AnimeManager();

    $anime = $animeManager->getAnimeById($id);
    $genres = $animeManager->getAnimeGenres($id);

    $relations = $animeManager->getAnimeRelations($id);
    $prequels = $relations['prequels'];
    $sequels = $relations['sequels'];

    $themes = $animeManager->getAnimeThemes($id);
    $openings = $themes['openings'];
    $endings = $themes['endings'];

    $reviews = $animeManager->getAnimeReviews($id);

    require('view/animeView.php');
}

function displayProfile($username)
{
    global $isConnected;
    $userManager = new UserManager();

    $profile = $userManager->getProfileByUsername($username);
    $stats = $userManager->getProfileStats($profile['id']);
    $totalAnimes = array_sum($stats);
    $history = $userManager->getProfileHistory($profile['id']);
    $totalEpisodes = $userManager->getProfileTotalEpisodes($profile['id']);

    require('view/profileView.php');
}

function loginUser($username, $password)
{
    global $isConnected;
    $userManager = new UserManager();

    // AUTRES VERIFICATIONS A EFFECTUER

    $hash = $userManager->checkPassword($username, $password);

    if(!$userManager->exists($username) || !$hash)
    {
        $errorMessage = 'Username or Password invalid';
        require('view/loginView.php');
        return;
    }

    setcookie('username', $username, time() + 7*24*3600, null, null, false, true);
    setcookie('password', $hash, time() + 7*24*3600, null, null, false, true);

    header('Location: ./');
}

function checkCookies()
{
    global $isConnected;
    if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
    {
        $userManager = new UserManager();

        $isConnected = $userManager->exists($_COOKIE['username']) && $userManager->checkPasswordHash($_COOKIE['username'], $_COOKIE['password']);
    }
}

function searchAnimeByTitle($title, $isSearchBar)
{
    global $isConnected;
    $animeManager = new AnimeManager();

    $data = $animeManager->getAnimesByTitle($title, $isSearchBar);

    if($isSearchBar)
    {
        echo json_encode($data);
    }
    else
    {
        $animes = $data['animes'];
        $genres = $data['genres'];

        $pageTitle = 'Search - MAL';
        $headerTitle = 'Search';    

        require('view/searchTemplate.php');
    }
}

function searchAnimeByGenre($genre)
{
    global $isConnected;
    $animeManager = new AnimeManager();

    $data = $animeManager->getAnimeByGenre($genre);

    $animes = $data['animes'];
    $genres = $data['genres'];
    $genre = $data['genre'];

    $pageTitle = $genre.' - MAL';
    $headerTitle = $genre.' Anime';

    require('view/searchTemplate.php');
}

function searchAnimeBySeason($season)
{
    global $isConnected;
    $animeManager = new AnimeManager();

    $season = urldecode($season);

    $data = $animeManager->getAnimeBySeason($season);

    $animes = $data['animes'];
    $genres = $data['genres'];
    $seasons = getSeasons($season);

    require('view/seasonView.php');
}

function displayIndex()
{
    global $isConnected;
    $currentSeason = getCurrentSeason();

    $animeManager = new AnimeManager();

    $currentSeasonAnime = $animeManager->getAnimeBySeason($currentSeason)['animes'];
    $topAiringAnime = $animeManager->getTopAiringAnime();
    $topUpcomingAnime = $animeManager->getTopUpcomingAnime();
    $mostPopularAnime = $animeManager->getMostPopularAnime();

    if($isConnected)
    {
        $userManager = new UserManager();
        $profile = $userManager->getProfileByUsername($_COOKIE['username']);
        $stats = $userManager->getProfileStats($profile['id']);
    }

    require('view/indexView.php');
}

function displayAnimeList($username)
{
    $userManager = new UserManager();

    $data = $userManager->getAnimeList($username);

    $animelist = $data['animes'];
    $lists = $data['lists'];

    require('view/animelistView.php');
}