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

$content = '<a href="index.php?a=anime&id=11617">Anime</a><a href="index.php?a=profile&username=Razalael">Profile</a>';

require('view/template.php');