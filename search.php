<?php
    include('assets/php/config.php');
    include('vimeo_setup.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Résultats de recherche</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/fil_actu2.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <script src="assets/js/libraries/svg-inject-master/src/svg-inject.js"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
    <style>
        .main_content {
            min-height: 100vh;
            height: max-content;
            background: var(--background);
            /* padding-top: 60px; */
        }
        nav {
            position: unset;
        }
        .result>iframe {
            width: 200px;
            height: auto;
            float: left;
            margin-left: 15px;
            border-radius: 10px !important;
        }
        .result h4,.result p {
            width: max-content;
            height: max-content;
            margin: 0px;
            /* float: right; */
        }
        .result {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            border-radius: 10px;
            border: darkgray 1px solid;
            height: max-content;
            margin-bottom: 15px;
            cursor: pointer;
        }
        .result>section {
            margin-left: 15px;
            height: max-content;
            max-width: 80%;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .omg_im_centered {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .horizontal_line {
            height: 1px;
            background: darkgray;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .result>.profile_picture {
            width: 100px;
            height: 100px;
            border-radius: 999px;
            margin: 15px;
        }
        .result .profile_description {
            max-width: 80%;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
<?php
    include("ressources/pop_up_film_information.php");
    include("ressources/pop_up_connexion.php");
    include("ressources/pop_up_share.php");
?>
<!-- Navigation menu -->
<nav>

    <!-- Logo Réah -->
    <a class="reah_logo_container" href="fil_actu.php"> <img src="sources/img/reah_logo_complet.png"
            class="reah_logo" alt=""></a>

    <div class="menu_nav">
        <!-- Categories's title -->
        <div class="menu_category">
            <p class="category_title category_title1" number="1" number1="2" number2="3">Ajouts récents</p>
            <p class="category_title category_title2" number="2" number1="1" number2="3">Défis du moment</p>
            <p class="category_title category_title3" number="3" number1="1" number2="2">À découvrir</p>
            <div class="red_line underline"></div>
            <div class="fb_jsb ai-c category_list">
                <p class="category_list_title">Catégories</p>
                <div class="category_triangle"></div>
            </div>
        </div>


        <!-- Search bar -->
        <form action="search.php" method="GET" class="form_search_bar">
            <input class="search_bar" name="research" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
        </form>

        <?php
            if(func::checkLoginState($db)){ # If the user is connected
                $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<div class='menu_profile'>
                <!-- Defi icon -->
                <a href='defis.php'> <img src='sources/img/defi_icon.svg' class='defi_icon' alt=''></a>
                <!-- Profile photo -->
                <img src='".$row['user_profile_picture']."' class='menu_pp' alt=''>
                </div>
                </nav>";

            } else {

                echo "<div class='menu_profile'>
                <!-- Defi icon -->
                <a href='defis.php'> <img src='sources/img/defi_icon.svg' class='defi_icon' alt=''></a>
                <!-- Profile photo -->
                    <div class='se-connecter' onclick='redirect(`login.php`)'>
                        <img src='sources/img/profil_icon.svg' class='menu_pp_icon' alt='Se connecter' onload='SVGInject(this)'>
                    </div>
                </div>
                </nav>";
            }
        ?>

        <!-- Category list  -->
        <div class="category_list_container">
            <p class="category_list_category" number="1" number1="2" number2="3">Ajouts récents</p>
            <p class="category_list_category" number="2" number1="1" number2="3">Défis du moment</p>
            <p class="category_list_category" number="3" number1="1" number2="2">À découvrir</p>
        </div>

        <!-- Menu -->
        <?php
            require("ressources/menu.php");
        ?>

        <!-- Nav footer -->

        <div class="nav_footer">
            <div class="nav_footer_category" number="1" number2="2" number3="3">
                <img src="sources/img/loupe_icon.svg" alt="">
                Ajouts récents</div>
            <div class="nav_footer_category" number="2" number2="1" number3="3">
                <img src="sources/img/loupe_icon.svg" alt="">
                Défis du moment</div>
            <div class="nav_footer_category" number="3" number2="1" number3="2">
                <img src="sources/img/loupe_icon.svg" alt="">
                À découvrir</div>
        </div>
</nav>
<main class="main_content">
    <h2 class="omg_im_centered">Courts-métrages</h2>
    <?php
        $research = htmlspecialchars($_GET['research']);

        # Non définitif, la requête finale incluera l'ensemble des tables.
        # Se référer au modèle conceptuel sur le drive
        $query = "SELECT demo_video_title,demo_video_author,demo_video_url,demo_video_id FROM demo_videos WHERE demo_video_title LIKE '%$research%' OR demo_video_author LIKE '%$research%';";

        $stmt = $db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            echo '<div class="result omg_im_centered">
                <iframe src="https://player.vimeo.com/video/'.$row['demo_video_url'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen id="video_'.$row['demo_video_id'].'"></iframe>
                <section>
                    <h4>'.$row['demo_video_title'].'</h4>
                    <br>
                    <p>de : '.$row['demo_video_author'].'</p>
                </section>
            </div>';
        }

    ?>

    <div class="horizontal_line omg_im_centered"></div>

    <h2 class="omg_im_centered">Membres</h2>
    <?php
        $query = "SELECT user_username,user_profile_picture,user_profile_description FROM users WHERE user_username LIKE '%$research%';";

        $stmt = $db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            echo '<div class="result omg_im_centered">
                <img src="'.$row['user_profile_picture'].'" class="profile_picture" alt="Photo de profil">
                <section>
                    <h4>'.$row['user_username'].'</h4>
                    <br>
                    <p class="profile_description">'.$row['user_profile_description'].'</p>
                </section>
            </div>';
        }
    ?>
</main>
<?php
    require('ressources/footer.php');
?>
</body>
</html>