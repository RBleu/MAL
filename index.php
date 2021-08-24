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
                    throw new Exception('anime not found (ID not valid)');
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