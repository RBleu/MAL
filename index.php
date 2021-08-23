<?php

//require('controller/controller.php');

$is_connected = false;

try
{
    if(isset($_GET['a']))
    {
        switch($_GET['a'])
        {
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