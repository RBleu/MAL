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
}