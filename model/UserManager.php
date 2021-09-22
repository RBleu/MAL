<?php

require_once('model/Manager.php');

class UserManager extends Manager
{
    public function exists($username)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE username = :username');
        $req->execute([':username' => $username]);

        return (bool) $req->fetch();
    }

    public function checkPassword($username, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT password FROM users WHERE username = :username');
        $req->execute([':username' => $username]);

        $hash = $req->fetch(PDO::FETCH_ASSOC)['password'];

        return (password_verify($password, $hash))? $hash : false;
    }

    public function checkPasswordHash($username, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
        $req->bindValue(':username', $username);
        $req->bindValue(':password', $password);

        $req->execute();

        return (bool) $req->fetch();
    }

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
        $req = $db->prepare('SELECT SUM(episodes) AS total_episodes FROM animes, users_lists, lists WHERE user_id = :id AND animes.id = anime_id AND lists.id = list_id AND list = "Completed"');
        $req->execute([':id' => $id]);

        return $req->fetch(PDO::FETCH_ASSOC)['total_episodes'];
    }

    public function getAnimeList($username)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT list, animes.id, cover, title, progress_episodes, episodes, premiered, aired_from, aired_to, priority FROM users_lists, users, animes, priorities, lists WHERE lists.id = list_id AND priority_id = priorities.id AND animes.id = anime_id AND users.id = user_id AND username = :username ORDER BY title');
        $req->execute([':username' => $username]);

        $animes = $req->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);

        $req->closeCursor();

        $req = $db->prepare('SELECT * FROM lists');
        $req->execute();

        $lists = $req->fetchAll(PDO::FETCH_ASSOC);

        return [
            'animes' => $animes,
            'lists' => $lists
        ];
    }
}