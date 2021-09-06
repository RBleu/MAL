<?php

$pageTitle = $season.' - MAL';
$headerTitle = $season;

ob_start();

?>
    <div id="anime-results-header">
        <div class="season-nav"><a href="#">...</a></div>
        <?php
            for($i = 0; $i < count($seasons); $i++)
            {
                if($i == 1)
                {
                    ?>
                        <div class="season-nav"><a class="selected" href="index.php?a=search&season=<?= urlencode($seasons[$i]) ?>"><?= $seasons[$i] ?></a></div>
                    <?php
                }
                else
                {
                    ?>
                        <div class="season-nav"><a href="index.php?a=search&season=<?= urlencode($seasons[$i]) ?>"><?= $seasons[$i] ?></a></div>
                    <?php
                }
            }
        ?>
        <form id="jump-form" action="index.php?a=jump" method="post">
            <div>Jump to</div>
            <select class="jump-input" name="season-select" id="season-select">
                <option value="winter">Winter</option>
                <option value="spring">Spring</option>
                <option value="summer">Summer</option>
                <option value="fall">Fall</option>
            </select>
            <input class="jump-input" type="text" name="year" id="year" size="4" placeholder="Year">
            <input id="go" type="submit" value="Go">
        </form>
    </div>
<?php

$animeResultsHeader = ob_get_clean();

require('view/searchTemplate.php');