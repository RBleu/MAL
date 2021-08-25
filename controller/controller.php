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

function searchAnime($title)
{
    $animeManager = new AnimeManager();

    $results = $animeManager->getAnimesByTitle($title);

    echo json_encode($results);
}