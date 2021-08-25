<?php

require('controller/controller.php');

checkCookies();

try
{
    if(isset($_GET['a']))
    {
        switch($_GET['a'])
        {
            case 'anime':
                if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
                {
                    displayAnime($_GET['id']);
                }
                else
                {
                    throw new Exception('Anime not found (ID not valid)');
                }
                break;
            case 'login':
                if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '')
                {
                    loginUser($_POST['username'], $_POST['password']);
                }
                else
                {
                    require('view/loginView.php');
                }
                break;
            case 'logout':
                setcookie('username');
                unset($_COOKIE['username']);

                setcookie('password');
                unset($_COOKIE['password']);

                header('Location: ./');
                break;
            case 'signup':
                if(false)
                {

                }
                else
                {
                    require('view/signupView.php');
                }
                break;
            case 'profile':
                if(isset($_GET['username']) && $_GET['username'] != '')
                {
                    displayProfile($_GET['username']);
                }
                else
                {
                    throw new Exception('Profile not found');
                }
                break;
            case 'search':
                if(isset($_GET['q']))
                {
                    searchAnime($_GET['q']);
                }
                break;
        }
    }
    else
    {
        require('view/indexView.php');
    }
}
catch(Exception $e)
{
    // Penser à faire une page
    die('Error : '.$e->getMessage());
}