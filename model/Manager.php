<?php

class Manager
{
    public function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=mal_test;charset=utf8', 'root', '');
        return $db;
    }
}