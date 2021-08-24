<?php

require_once('model/AnimeManager.php');

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