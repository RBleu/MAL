<?php

$pageTitle = 'MAL - Panel';

if($isConnected)
{
    $headerTitle = 'My Panel';
    $headerLinkIcon = 'cog';
    $headerLinkText = 'Panel Settings';
}
else
{
    $headerTitle = 'Welcome to MAL';
}

$content = '';

require('view/template.php');