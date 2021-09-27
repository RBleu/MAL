<?php

require('controller/controller.php');

checkCookies();

try
{
    if(isset($_GET['a']))
    {
        switch($_GET['a'])
        {
            case 'login':
                if($isConnected)
                {
                    header('Location: ./');
                    return;
                }

                if(isset($_POST['username']) && isset($_POST['password']))
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
                if($isConnected)
                {
                    header('Location: ./');
                    return;
                }

                if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm-password']))
                {
                    signUpUser($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm-password']);
                }
                else
                {
                    require('view/signupView.php');
                }
                break;
            case 'search':
                if(isset($_GET['q']) && $_GET['q'] != '')
                {
                    if(isset($_GET['js']))
                    {
                        searchAnimesByTitleJs($_GET['q']);
                    }
                    else
                    {
                        searchAnimesByTitle($_GET['q']);
                    }
                }
                elseif(isset($_GET['season']) && $_GET['season'] != '')
                {
                    searchAnimesBySeason($_GET['season']);
                }
                elseif(isset($_GET['genre']) && is_numeric($_GET['genre']) && $_GET['genre'] > 0)
                {
                    searchAnimesByGenre($_GET['genre']);
                }
                else
                {
                    throw new Exception('There is an issue with your search');
                }
                break;
            case 'jump':
                header('Location: index.php?a=search&season='.urlencode(ucfirst($_POST['season-select'].' '.$_POST['year'])));
                break;
            case 'anime':
                if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
                {
                    displayAnime($_GET['id']);
                }
                else
                {
                    throw new Exception('ID not specified or wrong ID (ID must be a positive number)');
                }
                break;
            case 'profile':
                if(isset($_GET['username']) && $_GET['username'] != '')
                {
                    displayProfile($_GET['username']);
                }
                else
                {
                    throw new Exception('Username not specified');
                }
                break;
            case 'animelist':
                if(isset($_GET['username']) && $_GET['username'] != '')
                {
                    if(isset($_GET['list']) && is_numeric($_GET['list']) && $_GET['list'] > 0)
                    {
                        displayAnimeList($_GET['username'], $_GET['list']);
                    }
                    else
                    {
                        displayAnimeList($_GET['username']);
                    }
                }
                else
                {
                    throw new Exception('Username not specified');
                }
                break;
            default:
                header('Location: ./');
                break;
        }
    }
    else
    {
        displayIndex();
    }
}
catch(Exception $e)
{
    // Page Erreur
    echo $e->getMessage();
}