<?php

require('controller/controller.php');

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
                if(false)
                {

                }
                else
                {
                    require('view/loginView.php');
                }
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