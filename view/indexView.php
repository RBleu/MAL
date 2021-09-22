<?php

$pageTitle  = 'MAL - Panel';
$styles     = ['splide.min', 'index'];
$scripts    = ['splide.min', 'index'];

if($isConnected)
{
    $headerTitle    = 'My Panel';
    $headerLinkIcon = 'cog';
    $headerLinkText = 'Panel Settings';
}
else
{
    $headerTitle = 'Welcome to MAL';
}

ob_start();

?>

<div id="content-container">
    <div id="content-left">
        <div class="info">
            <div class="title"><?= $currentSeason ?> Anime<a class="link" href="index.php?a=search&season=<?= urlencode($currentSeason) ?>">View More</a></div>
            <div class="info-content">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                                foreach($currentSeasonAnimes as $anime)
                                {
                                    ?>
                                        <li class="splide__slide">
                                            <div class="slide_anime">
                                                <div class="slide_cover"><img src="public/images/anime_covers/<?= $anime['cover'] ?>" alt="anime_cover"></div>
                                                <a href="index.php?a=anime&id=<?= $anime['id'] ?>" class="slide_title"><span><?= $anime['title']?></span></a>
                                            </div>
                                        </li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content-right">
        <?php
            if($isConnected)
            {
                ?>
                    <div class="info">
                        <div class="title">My Statistics</div>
                        <div class="info-content">
                            <?php
                                foreach($stats as $key => $value)
                                {
                                    ?>
                                        <div class="stats"><?= $key ?><div><?= $value ?></div></div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                <?php
            }

            foreach($topAnimes as $topTitle => $topArray)
            {
                ?>
                    <div class="top">
                        <div class="top-title"><?= $topTitle ?><a href="#" class="link">More</a></div>
                        <div class="top-content">
                <?php
                
                $size = count($topArray);
                for($i = 0; $i < $size; $i++)
                {
                    $anime = $topArray[$i];
                    ?>
                        <div class="top-anime">
                            <div class="top-number"><?= $i + 1 ?></div>
                            <div class="top-cover"><a href="index.php?a=anime&id=<?= $anime['id'] ?>"><img src="public/images/anime_covers/<?= $anime['cover'] ?>" alt="anime-cover"></a></div>
                            <div class="top-infos">
                                <div class="top-anime-title"><a href="index.php?a=anime&id=<?= $anime['id'] ?>" class="link"><?= $anime['title'] ?></a></div>
                                <div class="top-others"><?= $anime['type'].', '.(($anime['episodes'] == null)? 0 : $anime['episodes']).' eps, scored '.number_format($anime['score'], 2) ?></div>
                                <div class="top-members"><?= number_format($anime['members']) ?> members</div>
                            </div>
                            <div class="top-list">
                                <a href="#" class="add link">add</a>
                            </div>
                        </div>
                    <?php
                }

                ?>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');

?>