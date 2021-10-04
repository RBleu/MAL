<?php

$pageTitle = $anime['title'].' - MAL';
$headerTitle = $anime['title'];
$headerLinkIcon = 'pencil';
$hederLinkText = 'Edit';
$styles = ['anime'];
$scripts = ['anime'];

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
                <div id="genres">
                    <span>Genres: </span>
                    <?php
                        $genresHTML = [];
                        foreach($genres as $id => $genre)
                        {
                            $genresHTML[] = '<a href=\'index.php?a=search&genre='.$id.'\' class=\'link\'>'.$genre.'</a>';
                        }
                        echo implode(', ', $genresHTML);
                    ?>
                </div>
                <div><span>Duration: </span><?= $anime['duration'] ?></div>
            </div>
        </div>
    </div>
    <div id="content-right">
        <div id="stats">
            <div id="score">
                <div id="score-label">Score</div>
                <div id="score-value"><?= ($anime['score'] == null)? 'N/A' : number_format($anime['score'], 2) ?></div>
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
            <input id="anime-id" type="hidden" name="anime_id" value="<?= $anime['id'] ?>">
            <input id="selected-list" type="hidden" name="selected_list" value="<?= $selectedKey ?>">
            <select name="list-select" id="list-select" class="select <?= $selectedKey ?>" <?= ($isAlreadyAdd)? '' : 'style="display: none;"' ?>>
            <?php
                foreach($lists as $list)
                {
                    if($list['list_key'] == $selectedKey)
                    {
                        ?>
                            <option value="<?= $list['id'] ?>" selected="selected" key="<?= $list['list_key'] ?>"><?= $list['list'] ?></option>
                        <?php
                    }
                    else
                    {
                        ?>
                            <option value="<?= $list['id'] ?>" key="<?= $list['list_key'] ?>"><?= $list['list'] ?></option>
                        <?php
                    }
                    
                }
            ?>
            </select>
            <a href="#" id="add" <?= ($isAlreadyAdd)? 'style="display: none;"' : '' ?>><img src="public/images/icons/plus-square.svg" alt="plus-icon">Add to List</a>
            <select name="user-score" id="user-score" class="select" <?= ($isAlreadyAdd) ? '' : 'disabled=\'disabled\'' ?>>
                <?php
                    $scores = [
                        'Select',
                        '(1) Appalling',
                        '(2) Horrible',
                        '(3) Very Bad',
                        '(4) Bad',
                        '(5) Average',
                        '(6) Fine',
                        '(7) Good',
                        '(8) Very Good',
                        '(9) Great',
                        '(10) Masterpiece'
                    ];

                    for($i = 0; $i < 11; $i++)
                    {
                        $j = ($i == 0)? 0 : (11 - $i);

                        if($j == $score)
                        {
                            ?>
                                <option value="<?= $j ?>" selected="selected"><?= $scores[$j] ?></option>
                            <?php
                        }
                        else
                        {
                            ?>
                                <option value="<?= $j ?>"><?= $scores[$j] ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
            <div id="watch-episodes" <?= ($isAlreadyAdd) ? '' : 'class=\'disabled\'' ?>>
                Episodes:
                <input type="text" id="number-of-episodes" value="<?= $progressEpisodes ?>" <?= ($isAlreadyAdd) ? '' : 'disabled=\'disabled\'' ?>>/<span id="total-episodes"><?= ($anime['episodes'] == null)? '?' : $anime['episodes'] ?></span>
                <a href="#"><img src="public/images/icons/plus.svg" alt="plus-icon"></a>
            </div>
            <a href="#" id="delete" <?= ($isAlreadyAdd)? '' : 'style="display: none;"' ?>>Delete From List</a>
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
            <?php
                foreach($themes as $type => $songs)
                {
                    ?>  
                        <div class="info">
                            <div class="title"><?= $type ?> Theme<a href="#" class="link">Edit</a></div>
                            <div class="info-content"><?= implode('', array_map(function($val){ return '<div>'.$val.'</div>'; }, $songs)) ?></div>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');

?>