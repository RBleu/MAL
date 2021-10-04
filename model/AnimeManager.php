<?php

require_once('model/Manager.php');

class AnimeManager extends Manager
{
    public function getAnimeById($id)
    {
        $req = $this->db->prepare('SELECT * FROM animes WHERE animes.id = ?');
        $req->execute(array($id));

        $anime = $req->fetch(PDO::FETCH_ASSOC);

        $req->closeCursor();

        if(!$anime)
        {
            throw new Exception('Wrong ID: this anime doesn\'t exist or can\'t be found');
        }

        $req = $this->db->prepare('SELECT type FROM types WHERE id = ?');
        $req->execute(array($anime['type_id']));

        $anime['type'] = $req->fetch(PDO::FETCH_ASSOC)['type'];

        return $anime;
    }

    public function getAnimeGenres($id)
    {
        $req = $this->db->prepare('SELECT genres.id, genre FROM animes_genres, genres WHERE genre_id = genres.id AND anime_id = ?');
        $req->execute(array($id));

        $genres = $req->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);

        foreach($genres as $i => $genre)
        {
            $genres[$i] = $genre[0]['genre'];
        }

        return $genres;
    }

    public function getAnimeRelations($id)
    {
        $req = $this->db->prepare('SELECT id, title FROM animes_relations, animes WHERE sequel_id = ? AND animes.id = prequel_id');
        $req->execute(array($id));

        $prequels = $req->fetchAll(PDO::FETCH_ASSOC);

        $req->closeCursor();

        $req = $this->db->prepare('SELECT id, title FROM animes_relations, animes WHERE prequel_id = ? AND sequel_id = animes.id');
        $req->execute(array($id));

        $sequels = $req->fetchAll(PDO::FETCH_ASSOC);

        return [
            'prequels' => $prequels,
            'sequels'  => $sequels,
        ];
    }

    public function getAnimeThemes($id)
    {
        $req = $this->db->prepare('SELECT theme_type, theme FROM themes WHERE anime_id = ?');
        $req->execute(array($id));

        $themes = $req->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);

        foreach($themes as $type => $theme)
        {
            $themes[$type] = array_map(function($val){ return $val['theme']; }, $theme);
        }

        return $themes;
    }

    public function getAnimesBySeason($season)
    {
        $req = $this->db->prepare('SELECT animes.id, title, cover, aired_from, synopsis, type, score, members, episodes FROM animes, types WHERE type_id = types.id AND premiered = ?');
        $req->execute(array($season));

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopAnimes($order_by, $limit, $where = 1)
    {
        $req = $this->db->query("SELECT animes.id, title, cover, type, episodes, score, members FROM animes, types WHERE $where AND types.id = type_id ORDER BY $order_by DESC LIMIT $limit");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimesByTitleJs($title)
    {
        $req = $this->db->prepare('SELECT id, title, aired, status, score, cover FROM animes WHERE title LIKE ? LIMIT 10');
        $req->execute(array('%'.$title.'%'));

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimesByTitle($title)
    {
        $req = $this->db->prepare('SELECT animes.id, title, cover, aired_from, synopsis, type, score, members, episodes FROM animes, types WHERE type_id = types.id AND title LIKE ?');
        $req->execute(array('%'.$title.'%'));

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimesByGenre($genre)
    {
        $req = $this->db->prepare('SELECT animes.id, title, cover, aired_from, synopsis, type, score, members, episodes FROM animes, types, animes_genres WHERE type_id = types.id AND animes.id = anime_id AND genre_id = ?');
        $req->execute(array($genre));

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGenreById($id)
    {
        $req = $this->db->prepare('SELECT genre FROM genres WHERE id = ?');
        $req->execute(array($id));

        return $req->fetch(PDO::FETCH_ASSOC);
    }
}