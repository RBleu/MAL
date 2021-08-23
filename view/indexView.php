<?php

$pageTitle = 'MAL - Panel';

if($is_connected)
{
    $headerTitle = 'My Panel';
    $headerLink = '<img src=\'public/images/icons/cog.svg\' alt=\'cog-icon\'>Panel Settings';
}
else
{
    $headerTitle = 'Welcome to MAL';
}

$content = '';

require('view/template.php');