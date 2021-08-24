<?php

$pageTitle = 'MAL - Panel';

if(false)
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