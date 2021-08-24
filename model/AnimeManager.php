<?php

require_once('model/Manager.php');

class AnimeManager extends Manager
{
    function getAnimeById($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT title, cover, type, episodes, status, aired, premiered, duration, score, scored_by, rank, members, synopsis FROM animes, types WHERE type_id = types.id AND animes.id = :id');
        $req->execute([':id' => $id]);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    function getAnimeGenres($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT genre FROM genres, animes_genres WHERE genre_id = genres.id AND anime_id = :id');
        $req->execute([':id' => $id]);

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAnimeRelations($id)
    {
        $db = $this->dbConnect();

        // Prequels
        $req = $db->prepare('SELECT id, title FROM animes, animes_relations WHERE sequel_id = :id AND prequel_id = animes.id');
        $req->execute([':id' => $id]);

        $prequels = $req->fetchAll(PDO::FETCH_ASSOC);

        $req->closeCursor();

        // Sequels
        $req = $db->prepare('SELECT id, title FROM animes, animes_relations WHERE prequel_id = :id AND sequel_id = animes.id');
        $req->execute([':id' => $id]);

        $sequels = $req->fetchAll(PDO::FETCH_ASSOC);

        $req->closeCursor();

        return [
            'prequels' => $prequels,
            'sequels'  => $sequels
        ];
    }

    function getAnimeThemes($id)
    {
        $db = $this->dbConnect();

        // Openings
        $req = $db->prepare('SELECT theme FROM themes WHERE anime_id = :id AND theme_type = \'Opening\'');
        $req->execute([':id' => $id]);

        $openings = $req->fetchAll(PDO::FETCH_ASSOC);

        $req->closeCursor();

        // Endings
        $req = $db->prepare('SELECT theme FROM themes WHERE anime_id = :id AND theme_type = \'Ending\'');
        $req->execute([':id' => $id]);

        $endings = $req->fetchAll(PDO::FETCH_ASSOC);

        $req->closeCursor();

        return [
            'openings' => $openings,
            'endings'  => $endings
        ];
    }

    function getAnimeReviews($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT username, review, likes FROM reviews, users WHERE anime_id = :id AND user_id = users.id ORDER BY likes DESC LIMIT 3');
        $req->execute([':id' => $id]);

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}