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

$style = 'index';

ob_start();

?>

<div id="content-container">
    <div id="content-left">
        <div class="info">
            <div class="title"><?= $currentSeason ?> Anime<a class="link" href="index.php?a=search&season=<?= urlencode($currentSeason) ?>">View More</a></div>
            <div class="info-content">
                <!-- Slider -->
            </div>
        </div>
    </div>
    <div id="content-right"></div>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');

?>