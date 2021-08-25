<?php

require_once('model/Manager.php');

class UserManager extends Manager
{
    public function getProfileByUsername($username)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, image, signup_date FROM users WHERE username = :username');
        $req->execute([':username' => $username]);

        $profile = $req->fetch(PDO::FETCH_ASSOC);

        if(!$profile)
        {
            throw new Exception('User not found');
        }

        return $profile;
    }

    public function getProfileStats($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT list, COUNT(user_id) AS total FROM lists LEFT JOIN (SELECT * FROM users_lists WHERE user_id = :id) ul ON lists.id = ul.list_id GROUP BY list');
        $req->execute([':id' => $id]);

        $stats = $req->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
        $stats = array_map(function($val){ return $val[0]['total']; }, $stats);

        return $stats;
    }

    public function getProfileHistory($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT animes.id, title, episodes, cover, progress_episodes, users_lists.score, modification_date, list FROM animes, users_lists, lists WHERE user_id = :id AND anime_id = animes.id AND list_id = lists.id ORDER BY modification_date DESC LIMIT 3');
        $req->execute([':id' => $id]);

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfileTotalEpisodes($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT SUM(episodes) AS total_episodes FROM animes, users_lists WHERE user_id = :id AND animes.id = anime_id');
        $req->execute([':id' => $id]);

        return $req->fetch(PDO::FETCH_ASSOC)['total_episodes'];
    }
}