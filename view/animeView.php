<?php

$pageTitle = $anime['title'].' - MAL';
$headerTitle = $anime['title'];
$headerLinkIcon = 'pencil';
$hederLinkText = 'Edit';
$style = 'anime';

ob_start();

?>

<div id="content-container">
    <div id="content-left">
        <div id="cover"><img src="public/images/anime_covers/<?= $anime['cover'] ?>" alt="cover"></div>
        <div class="info">
            <div class="title">Information</div>
            <div class="info-content">
                <div><span>Type: </span><a href="#" class="link"><?= $anime['type'] ?></a></div>
                <div><span>Episodes: </span><?= ($anime['episodes'] == null)? 'Unknown' : $anime['episodes'] ?></div>
                <div><span>Status: </span><?= $anime['status'] ?></div>
                <div><span>Aired: </span><?= $anime['aired'] ?></div>
                <?php
                    if($anime['premiered'] != null)
                    {
                        ?>
                            <div><span>Premiered: </span><a href="index.php?a=search&season=<?= urlencode($anime['premiered']) ?>" class="link"><?= $anime['premiered'] ?></a></div>
                        <?php
                    }
                ?>
                <div id="genres"><span>Genres: </span><?= implode(', ', array_map(function($val){ return '<a href=\'index.php?a=search&genre='.$val['id'].'\' class=\'link\'>'.$val['genre'].'</a>'; }, $genres)) ?></div>
                <div><span>Duration: </span><?= $anime['duration'] ?></div>
            </div>
        </div>
    </div>
    <div id="content-right">
        <div id="stats">
            <div id="score">
                <div id="score-label">Score</div>
                <div id="score-value"><?= ($anime['score'] == null)? 'N/A' : $anime['score'] ?></div>
            </div>
            <div class="stats-content">
                <div id="rank-label">Ranked</div>
                <div class="value"><?= ($anime['rank'] == null)? 'N/A' : '#'.$anime['rank'] ?></div>
            </div>
            <div class="stats-content">
                <div id="scored-by-label">Scored By</div>
                <div class="value"><?= ($anime['scored_by'] == null)? '0' : number_format($anime['scored_by']) ?> Users</div>
            </div>
            <div class="stats-content">
                <div id="members-label">Members</div>
                <div class="value"><?= ($anime['members'] == null)? '0' : number_format($anime['members']) ?></div>
            </div>
        </div>
        <div id="add-to-list">
            <?php
                if(false)
                {
                    ?>
                        <select name="list-select" id="list-select" class="select">
                            <option value="1">Watching</option>
                            <option value="2">Completed</option>
                            <option value="3">On-Hold</option>
                            <option value="4">Dropped</option>
                            <option value="5" selected="selected">Plan to Watch</option>
                        </select>
                    <?php
                }
                else
                {
                    ?>
                        <a href="#" id="add"><img src="public/images/icons/plus-square.svg" alt="plus-icon">Add to List</a>
                    <?php
                }
            ?>
            <select name="user-score" id="user-score" class="select" <?= (false) ? '' : 'disabled=\'disabled\'' ?>>
                <option value="0" selected="selected">Select</option>
                <option value="10">(10) Masterpiece</option>
                <option value="9">(9) Great</option>
                <option value="8">(8) Very Good</option>
                <option value="7">(7) Good</option>
                <option value="6">(6) Fine</option>
                <option value="5">(5) Average</option>
                <option value="4">(5) Bad</option>
                <option value="3">(3) Very Bad</option>
                <option value="2">(2) Horrible</option>
                <option value="1">(1) Appalling</option>
            </select>
            <div id="watch-episodes" <?= (false) ? '' : 'class=\'disabled\'' ?>>
                Episodes:
                <input type="text" id="number-of-episodes" value="0" <?= (false) ? '' : 'disabled=\'disabled\'' ?>>/<span id="total-episodes"><?= ($anime['episodes'] == null)? '?' : $anime['episodes'] ?></span>
                <a href="#"><img src="public/images/icons/plus.svg" alt="plus-icon"></a>
            </div>
        </div>
        <div class="info">
            <div class="title">Synopsis<a href="#" class="link">Edit</a></div>
            <div class="info-content"><div><?= $anime['synopsis'] ?></div></div>
        </div>
        <?php
            if($prequels || $sequels)
            {
                ?>
                    <div class="info">
                        <div class="title">Related Anime<a href="#" class="link">Edit</a></div>
                        <div class="info-content">
                            <?php
                                $link = function($val) { return '<a href=\'index.php?a=anime&id='.$val['id'].'\' class=\'link\'>'.$val['title'].'</a>'; };
                                if(count($prequels) != 0)
                                {
                                    echo '<div>Prequel: '.implode(', ', array_map($link, $prequels)).'</div>';
                                }

                                if(count($sequels) != 0)
                                {
                                    echo '<div>Sequel: '.implode(', ', array_map($link, $sequels)).'</div>';
                                }
                            ?>
                        </div>
                    </div>
                <?php
            }
        ?>
        <div id="themes">
            <div class="info">
                <div class="title">Opening Theme<a href="#" class="link">Edit</a></div>
                <div class="info-content"><?= implode('', array_map(function($val){ return '<div>'.$val['theme'].'</div>'; }, $openings)) ?></div>
            </div>
            <div class="info">
                <div class="title">Ending Theme<a href="#" class="link">Edit</a></div>
                <div class="info-content"><?= implode('', array_map(function($val){ return '<div>'.$val['theme'].'</div>'; }, $endings)) ?></div>
            </div>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');

?>