<?php

require_once('model/AnimeManager.php');
require_once('model/UserManager.php');

function print_a($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function displayAnime($id)
{
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
    $userManager = new UserManager();

    $stats = $userManager->getProfileStats(1);

    print_a($stats);
}