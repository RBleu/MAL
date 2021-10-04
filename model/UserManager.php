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

    public function getAnimeList($username, $listId)
    {
        $req = $this->db->prepare('SELECT animes.id, cover, title, progress_episodes, episodes, premiered, aired_from, aired_to, priority FROM users_lists, users, animes, priorities WHERE priority_id = priorities.id AND animes.id = anime_id AND users.id = user_id AND username = :username AND list_id = :list_id ORDER BY title');
        $req->bindValue(':username', $username);
        $req->bindValue(':list_id', $listId, PDO::PARAM_INT);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllLists()
    {
        $req = $this->db->prepare('SELECT * FROM lists');
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exists($username)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute(array($username));

        return (bool) $req->fetch();
    }

    public function emailExists($email)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $req->execute(array($email));

        return (bool) $req->fetch();
    }

    public function createUser($email, $username, $hash)
    {
        $this->db->beginTransaction();

        try
        {
            $req = $this->db->prepare('INSERT INTO users(username, password, email, image, role, signup_date) VALUES(:username, :password, :email, "30327.jpg", "User", NOW())');
            $req->bindValue(':username', $username);
            $req->bindValue(':password', $hash);
            $req->bindValue(':email', $email);

            $req->execute();

            $this->db->commit();
        }
        catch(Exception $e)
        {
            $this->db->rollBack();
            return $e->getMessage();
        }

        return true;
    }

    public function getListOf($username, $animeId)
    {
        $req = $this->db->prepare('SELECT list_key, progress_episodes, users_lists.score FROM users, users_lists, lists WHERE username = :username AND users.id = user_id AND lists.id = list_id AND anime_id = :anime_id');
        $req->bindValue(':username', $username);
        $req->bindValue(':anime_id', $animeId);

        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserAnimeList($username, $animeId, $listId, $score, $progressEpisodes, $type)
    {
        $req = $this->db->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute(array($username));

        $id = $req->fetch(PDO::FETCH_ASSOC)['id'];

        $req->closeCursor();

        $this->db->beginTransaction();

        try
        {
            if($type == 'insert')
            {
                $req = $this->db->prepare('INSERT INTO users_lists(user_id, anime_id, list_id, score, modification_date, priority_id, progress_episodes) VALUES (:user_id, :anime_id, :list_id, :score, NOW(), 2, :progress_episodes)');
            }
            else
            {
                $req = $this->db->prepare('UPDATE users_lists SET list_id = :list_id, score = :score, modification_date = NOW(), progress_episodes = :progress_episodes WHERE user_id = :user_id AND anime_id = :anime_id');
            }

            $req->bindValue(':user_id', $id, PDO::PARAM_INT);
            $req->bindValue(':anime_id', $animeId, PDO::PARAM_INT);
            $req->bindValue(':list_id', $listId, PDO::PARAM_INT);
            $req->bindValue(':score', $score, PDO::PARAM_INT);
            $req->bindValue(':progress_episodes', $progressEpisodes, PDO::PARAM_INT);

            $req->execute();

            $this->db->commit();
        }
        catch(Exception $e)
        {
            $this->db->rollBack();
            return $e->getMessage();
        }

        return true;
    }

    public function deleteAnimeFromUserList($username, $animeId)
    {
        $req = $this->db->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute(array($username));

        $id = $req->fetch(PDO::FETCH_ASSOC)['id'];

        $req->closeCursor();

        $this->db->beginTransaction();

        try
        {
            $req = $this->db->prepare('DELETE FROM users_lists WHERE user_id = :user_id AND anime_id = :anime_id');
            $req->bindValue(':user_id', $id, PDO::PARAM_INT);
            $req->bindValue(':anime_id', $animeId, PDO::PARAM_INT);

            $req->execute();

            $this->db->commit();
        }
        catch(Exception $e)
        {
            $this->db->rollBack();
            return $e->getMessage();
        }

        return true;
    }
}