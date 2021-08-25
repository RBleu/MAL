<?php

$pageTitle = $username.'\'s Profile - MAL';
$headerTitle = $username.'\'s Profile';
$headerLinkIcon = 'cog';
$headerLinkText = 'Edit Profile';
$style = 'profile';

ob_start();

?>

<div id="content-container">
    <div id="content-left">
        <div id="cover"><img src="public/images/profile_images/<?= $profile['image'] ?>" alt="profile-image"></div>
        <div id="joined"><span>Joined</span> <div><?= formatDate('M d, Y', $profile['signup_date']); ?></div></div>
        <div>
            <a href="#" class="btn">Anime List</a>
        </div>
    </div>

    <div id="content-right">
        <div id="stats" class="info">
            <div class="title">Statistics</div>
            <div class="info-content">
                <div class="info">
                    <?php
                        $statsGraphWidth = 380;
                        $statsGraphDivs = '';
                        $statsGraphDetail = '';

                        foreach($stats as $key => $value)
                        {
                            $className = str_replace(' ', '-', strtolower($key));

                            $statsGraphDivWidth = ($totalAnimes == 0)? 0 : round(($value/$totalAnimes) * $statsGraphWidth);

                            $statsGraphDivs .= '<div class=\''.$className.'\' style=\'width: '.$statsGraphDivWidth.'px\'></div>';
                            $statsGraphDetail .= '<div><div class=\'circle '.$className.'\'></div><a href=\'#\' class=\'link\'>'.$key.'</a><div class=\'value\'>'.$value.'</div></div>';
                        }
                    ?>
                    <div class="title">Anime Stats</div>
                    <div class="info-content">
                        <div id="stats-graph"><?= $statsGraphDivs ?></div>
                        <div id="stats-detail">
                            <div id="stats-detail-left"><?= $statsGraphDetail ?></div>
                            <div id="stats-detail-right">
                                <div>Total Entries<div class="value"><?= $totalAnimes ?></div></div>
                                <div>Episodes<div class="value"><?= $totalEpisodes ?></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="last-anime-updates" class="info">
                    <div class="title">Last Anime Updates<a href="#" class="link">Anime History</a></div>
                    <div class="info-content">
                        <?php
                            $progressWidth = 194;

                            foreach($history as $ah)
                            {
                                $animeProgressWidth = round(($ah['progress_episodes']/$ah['episodes']) * $progressWidth);
                                ?>
                                    <div class="updated-anime">
                                        <div class="updated-anime-cover"><a href="index.php?a=anime&id=<?= $ah['id'] ?>"><img src="public/images/anime_covers/<?= $ah['cover'] ?>" alt="anime-cover"></a></div>
                                        <div class="updated-anime-infos">
                                            <div class="updated-anime-title"><a href="index.php?a=anime&id=<?= $ah['id'] ?>" class="link"><?= $ah['title'] ?></a></div>
                                            <div class="updated-anime-progress"><div style="width: <?= $animeProgressWidth ?>px"></div></div>
                                            <div class="updated-anime-score"><?= $ah['list'] ?> · <?= 'Scored '.(($ah['score'] == null)? '-' : $ah['score']) ?></div>
                                        </div>
                                        <div class="modification-date"><?= formatDate('M d, Y h:i A', $ah['modification_date']) ?></div>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');

?>