<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $username ?>'s Anime List - MAL</title>

    <link rel="stylesheet" href="public/DataTables/datatables.min.css">
    <link rel="stylesheet" href="public/css/animelist.css">

    <script src="public/js/jquery-3.6.0.min.js"></script>
    <script src="public/DataTables/datatables.min.js"></script>
    <script src="public/js/animelist.js"></script>
</head>
<body>
    <div id="header">
        <div id="logo">
            <a href="./"><img src="public/images/logo.png" alt="logo"></a>
        </div>
    </div>
    <div id="mal">
        <div id="cover">
            <div id="cover-img"></div>
        </div>
        <div id="navbar">
            <?php
                foreach($lists as $list)
                {
                    ?>
                        <a href="#" value="<?= $list['list_key'] ?>"><?= $list['list'] ?></a>
                    <?php
                }
            ?>
        </div>
        <div id="tables">
            <?php
                foreach($lists as $list)
                {
                    ?>
                        <table id="<?= $list['list_key'] ?>">
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
                                <?php
                                    if(isset($animelist[$list['list']]))
                                    {
                                        ?>  
                                            <tbody>
                                        <?php
                                        foreach($animelist[$list['list']] as $key => $anime)
                                        {
                                            ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><a href="index.php?a=anime&id=<?= $anime['id'] ?>"><img src="public/images/anime_covers/<?= $anime['cover'] ?>" alt=""></a></td>
                                                    <td><a href="index.php?a=anime&id=<?= $anime['id'] ?>"><?= $anime['title'] ?></a></td>
                                                    <td><?= $anime['progress_episodes'].'/'.$anime['episodes'] ?></td>
                                                    <td><?= $anime['premiered'] ?></td>
                                                    <td><?= $anime['aired_from'] ?></td>
                                                    <td><?= $anime['aired_to'] ?></td>
                                                    <td><?= $anime['priority'] ?></td>
                                                </tr>
                                            <?php
                                        }
                                        ?>
                                            </tbody>
                                        <?php
                                    }
                                ?>
                        </table>
                    <?php
                }
            ?>
        </div>
    </div>
</body>
</html>