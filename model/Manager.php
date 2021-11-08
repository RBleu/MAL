<?php

define('HOST', 'localhost');
define('DBNAME', 'mal');
define('USERNAME', 'root');
define('PASSWORD', '');

class Manager
{
    protected $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', USERNAME, PASSWORD);
    }
}