<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>

    <!--    Styles    -->
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/template.css">

    <?php
        if(isset($styles))
        {
            foreach($styles as $style)
            {
                ?>
                    <link rel="stylesheet" href="public/css/<?= $style ?>.css">
                <?php
            }
        }
    ?>

    <!--    Scripts    -->
    <script src="public/js/jquery-3.6.0.min.js"></script>

    <?php
        if(isset($scripts))
        {
            foreach($scripts as $script)
            {
                ?>
                    <script src="public/js/<?= $script ?>.js"></script>
                <?php
            }
        }
    ?>

    <script src="public/js/script.js"></script>
</head>
<body>
    <div id="mal">
        <div id="header">
            <div id="logo">
                <a href="./"><img src="public/images/logo.png" alt="logo"></a>
            </div>
            <div id="header-menu">
                <?php
                    if($isConnected)
                    {
                        ?>
                            <div class="header-icon">
                                <a href="#" class="header-img"><img src="public/images/icons/list.svg" alt="list-icon"></a>
                                <div class="header-sub-menu">
                                    <div class="header-sub-menu-item"><a href="#">Anime List</a></div>
                                    <div class="header-sub-menu-item"><a href="#">Manga List</a></div>
                                    <div class="header-sub-menu-item"><a href="#">Quick Add</a></div>
                                    <div class="header-sub-menu-item"><a href="#">List Settings</a></div>
                                </div>
                            </div>
                            <div class="header-icon">
                                <a href="#" class="header-img"><img src="public/images/icons/envelope.svg" alt="message-icon"></a>
                            </div>
                            <div class="header-icon">
                                <a href="#" class="header-img"><img src="public/images/icons/bell.svg" alt="notification-icon"></a>
                            </div>
                            <div id="profile">
                                <div id="profile-menu">
                                    <a href="#" id="username"><?= $_COOKIE['username'] ?></a>
                                    <div class="header-sub-menu">
                                        <div class="header-sub-menu-item"><a href="index.php?a=profile&username=<?= $_COOKIE['username'] ?>">Profile</a></div>
                                        <div class="header-sub-menu-item"><a href="#">Friends</a></div>
                                        <div class="header-sub-menu-item"><a href="#">Clubs</a></div>
                                        <div class="header-sub-menu-item"><a href="#">Blog Posts</a></div>
                                        <div class="header-sub-menu-item"><a href="#">Reviews</a></div>
                                        <div class="header-sub-menu-item"><a href="#">Recommendations</a></div>
                                        <div class="header-sub-menu-item"><a href="#"><img src="public/images/icons/book.svg" alt="book-icon">Bookshelf</a></div>
                                        <div class="header-sub-menu-item"><a href="#"><img src="public/images/icons/cog.svg" alt="cog-icon">Account Settings</a></div>
                                        <div class="header-sub-menu-item"><a href="index.php?a=logout"><img src="public/images/icons/logout.svg" alt="logout-icon">Logout</a></div>
                                    </div>
                                </div>
                                <a href="index.php?a=profile&username=<?= $_COOKIE['username'] ?>" id="profile-img"><img src="public/images/profile_images/profile.png" alt="profile-image"></a>
                            </div>
                        <?php
                    }
                    else
                    {
                        ?>
                            <a href="index.php?a=login" id="login-btn" class="btn">Login</a>
                            <a href="#" id="signup-btn" class="btn">Sign Up</a>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div id="navbar">
            <div id="menu">
                <div class="menu-item">
                    <a href="#" class="menu-title">Anime</a>
                    <div class="sub-menu">
                        <a href="#" class="sub-menu-item">Anime Search</a>
                        <a href="#" class="sub-menu-item">Top Anime</a>
                        <a href="#" class="sub-menu-item">Seasonal Anime</a>
                        <a href="#" class="sub-menu-item">Videos</a>
                        <a href="#" class="sub-menu-item">Reviews</a>
                        <a href="#" class="sub-menu-item">Recommendations</a>
                        <a href="#" class="sub-menu-item">2021 Challenge</a>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="#" class="menu-title">Manga</a>
                    <div class="sub-menu">
                        <a href="#" class="sub-menu-item">Manga Search</a>
                        <a href="#" class="sub-menu-item">Top Manga</a>
                        <a href="#" class="sub-menu-item">Manga Store</a>
                        <a href="#" class="sub-menu-item">Reviews</a>
                        <a href="#" class="sub-menu-item">Recommendations</a>
                        <a href="#" class="sub-menu-item">2021 Challenge</a>
                    </div>
                </div>
            </div>
            <form action="index.php" id="searchbar" method="GET">
                <div id="searchbar-container">
                    <input type="hidden" name="a" value="search">
                    <input type="text" name="q" id="search" autocomplete="off">
                    <div id="search-result"></div>
                </div>
                <button id="search-btn" type="submit"><img src="public/images/icons/search.svg" alt="search-icon"></button>
            </form>
        </div>
        <div id="content-wrapper">
            <div id="content-header">
                <div id="content-header-title"><?= $headerTitle ?></div>
                <?php
                    if(isset($headerLinkIcon) && isset($headerLinkText))
                    {
                        ?>
                            <a href="#" class="link"><img src="public/images/icons/<?= $headerLinkIcon ?>.svg" alt="<?= $headerLinkIcon ?>-icon"><?= $headerLinkText ?></a>
                        <?php
                    }
                ?>
            </div>
            <div id="content"><?= $content ?></div>
        </div>
    </div>
</body>
</html>