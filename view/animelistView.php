<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $username ?>'s Anime List - MAL</title>

    <link rel="stylesheet" href="public/DataTables/datatables.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/animelist.css">

    <script src="public/js/jquery-3.6.0.min.js"></script>
    <script src="public/DataTables/datatables.min.js"></script>
    <script src="public/js/animelist.js"></script>
</head>
<body>
    <div id="mal">
        <div id="header">
            <div id="logo">
                <a href="./"><img src="public/images/logo.png" alt="logo"></a>
            </div>
        </div>
        <div id="mal-content">
            <div id="cover">
                <div id="cover-img"></div>
            </div>
            <div id="navbar">
                <?php
                    foreach($lists as $list)
                    {
                        if($list['id'] == $listId)
                        {
                            ?>
                                <a href="index.php?a=animelist&username=<?= $username ?>&list=<?= $list['id'] ?>" class="selected"><?= $list['list'] ?></a>
                            <?php
                        }
                        else
                        {
                            ?>
                                <a href="index.php?a=animelist&username=<?= $username ?>&list=<?= $list['id'] ?>"><?= $list['list'] ?></a>
                            <?php
                        }
                    }
                ?>
            </div>
            <div id="table-wrapper">
                <table id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Anime Title</th>
                            <th>Progress</th>
                            <th>Premiered</th>
                            <th>Air Start</th>
                            <th>Air End</th>
                            <th>Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($animelist as $anime)
                            {
                                ?>
                                    <tr>
                                        <td></td>
                                        <td><a href="index.php?a=anime&id=<?= $anime['id'] ?>"><img height="70" width="50" src="public/images/anime_covers/<?= $anime['cover'] ?>" alt=""></a></td>
                                        <td><a href="index.php?a=anime&id=<?= $anime['id'] ?>" class="link"><?= $anime['title'] ?></a></td>
                                        <td>
                                            <div class="watch-episodes">
                                                <input type="text" class="number-of-episodes" value="<?= $anime['progress_episodes'] ?>">/<span class="total-episodes"><?= ($anime['episodes'] == null)? '-' : $anime['episodes'] ?></span>
                                                <a href="#"><img src="public/images/icons/plus.svg" alt="plus-icon"></a>
                                            </div>
                                        </td>
                                        <td><a href="index.php?a=search&season=<?= urlencode($anime['premiered']) ?>" class="link"><?= $anime['premiered'] ?></a></td>
                                        <td><?= $anime['aired_from'] ?></td>
                                        <td><?= $anime['aired_to'] ?></td>
                                        <td><?= $anime['priority'] ?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>