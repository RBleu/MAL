<?php

require_once('model/Manager.php');

class UserManager extends Manager
{
    public function check($username, $password)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
        $req->bindValue(':username', $username);
        $req->bindValue(':password', $password);

        $req->execute();

        return (bool) $req->fetch();
    }

    public function getPasswordHash($username)
    {
        $req = $this->db->prepare('SELECT password FROM users WHERE username = ?');
        $req->execute(array($username));

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getProfileByUsername($username)
    {
        $req = $this->db->prepare('SELECT image, signup_date FROM users WHERE username = ?');
        $req->execute(array($username));

        $profile = $req->fetch(PDO::FETCH_ASSOC);

        if(!$profile)
        {
            throw new Exception('This user doesn\'t exist');
        }

        return $profile;
    }

    public function getProfileStats($username)
    {
        $req = $this->db->prepare('SELECT list, COUNT(user_id) AS total FROM lists LEFT JOIN (SELECT * FROM users_lists, users WHERE user_id = users.id AND username = ?) ul ON lists.id = ul.list_id GROUP BY list');
        $req->execute(array($username));

        $stats = $req->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
        $stats = array_map(function($val){ return $val[0]['total']; }, $stats);

        return $stats;
    }

    public function getProfileHistory($username)
    {
        $req = $this->db->prepare('SELECT animes.id, title, episodes, cover, progress_episodes, users_lists.score, modification_date, list FROM animes, users_lists, lists, users WHERE user_id = users.id AND anime_id = animes.id AND list_id = lists.id AND username = ? ORDER BY modification_date DESC LIMIT 3');
        $req->execute(array($username));

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfileTotalEpisodes($username)
    {
        $req = $this->db->prepare('SELECT SUM(episodes) AS total_episodes FROM animes, users_lists, lists, users WHERE user_id = users.id AND animes.id = anime_id AND lists.id = list_id AND list = "Completed" AND username = ?');
        $req->execute(array($username));

        return $req->fetch(PDO::FETCH_ASSOC)['total_episodes'];
    }

    public function getAnimeList($username)
    {
        $req = $this->db->prepare('SELECT list, animes.id, cover, title, progress_episodes, episodes, premiered, aired_from, aired_to, priority FROM users_lists, users, animes, priorities, lists WHERE lists.id = list_id AND priority_id = priorities.id AND animes.id = anime_id AND users.id = user_id AND username = ? ORDER BY title');
        $req->execute(array($username));

        return $req->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
    }

    public function getAllLists()
    {
        $req = $this->db->prepare('SELECT * FROM lists');
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}