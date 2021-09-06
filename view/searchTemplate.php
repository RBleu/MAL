<?php

$style = 'search';

ob_start();

if(isset($animeResultsHeader))
{
    echo $animeResultsHeader;
}

?>

<div id="results-wrapper">
    <?php
        foreach($animes as $anime)
        {
            ?>
                <div class="anime-result">
                    <div class="anime-title"><a class="link" href="index.php?a=anime&id=<?= $anime['id'] ?>"><?= $anime['title'] ?></a></div>
                    <div class="anime-episodes"><?= $anime['episodes'] ?> eps</div>
                    <div class="anime-genres">
                        <?php
                            foreach($genres[$anime['id']] as $genre)
                            {
                                ?>
                                    <div class="anime-genre"><a href="index.php?a=search&genre=<?= $genre['id'] ?>"><?= $genre['genre'] ?></a></div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="anime-cover-synopsis">
                        <div class="anime-cover"><a href="index.php?a=anime&id=<?= $anime['id'] ?>"><img src="public/images/anime_covers/<?= $anime['cover'] ?>" alt="anime-cover"></a></div>
                        <div class="anime-synopsis"><?= $anime['synopsis'] ?></div>
                    </div>
                    <div class="anime-infos">
                        <div class="anime-infos-left"><?= $anime['type'].' - '.formatDate('M j, Y', $anime['aired_from']) ?></div>
                        <div class="anime-infos-right">
                            <div><?= $anime['score'] ?></div>
                            <div><?= $anime['members'] ?></div>
                        </div>
                    </div>
                </div>
            <?php
        }
    ?>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');

?>