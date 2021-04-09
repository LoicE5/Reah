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
    <link rel="stylesheet" href="assets/css/saved.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <script src="assets/js/libraries/svg-inject-master/src/svg-inject.js"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
</head>

<body>
    <?php
    // include("ressources/pop_up_film_information.php");
    include("ressources/pop_up_connexion.php");
    // include("ressources/pop_up_share.php");
?>
    <!-- Navigation menu -->



    <nav class="menu_nav">
        <!-- Logo Réah -->
        <a href="fil_actu.php" class="reah_logo"></a>

        <!-- Search bar -->
        <form action="search.php" method="GET" class="form_search_bar">
            <input class="search_bar" name="research" type="text" placeholder="Défis, courts-métrages, utilisateurs..." oninput="searchEngine(this.value)">
        </form>

        <?php
            if (func::checkLoginState($db)) { # If the user is connected
                $query = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<div class='menu_profile'>
                    <!-- Fil actu icon -->
                    <form action='fil_actu.php' method='GET'>
                    <button type='submit' name='accueil' class='fil_actu_icon' value='true'></button>
                    </form>
                    <!-- Defi icon -->
                    <a href='defis.php' class='defi_icon'></a>
                    <!-- Profile photo -->
                        <img src='database/profile_pictures/".$row['user_profile_picture']."' class='menu_pp' onclick='toggleBurgerMenu()'>
                        </div>";
            } else {
                echo "<div class='menu_profile'>
                    <!-- Fil actu icon -->
                    <form action='fil_actu.php' method='GET'>
                    <button type='submit' name='accueil' class='fil_actu_icon' value='true'></button>
                    </form>
                    <!-- Defi icon -->
                    <a href='defis.php' class='defi_icon'></a>
                    <!-- Profile photo -->
                    <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'>
                    </div>";
                }
                ?>
    </nav>

    <!-- Menu -->
    <?php
            require("ressources/menu.php");
        ?>


    <main class="main_content">
        <h2 class="omg_im_centered">Courts-métrages</h2>
        <?php
        $research = htmlspecialchars($_GET['research']);

        # Non définitif, la requête finale incluera l'ensemble des tables.
        # Se référer au modèle conceptuel sur le drive
        $query = "SELECT * FROM videos, users WHERE video_title LIKE '%$research%' AND video_user_id = user_id;";

        $stmt = $db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            echo '<a href="profil.php?id='.$row['video_user_id'].'" class="result omg_im_centered">
                <iframe src="https://player.vimeo.com/video/'.$row['video_url'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen id="video_'.$row['video_id'].'"></iframe>
                <section>
                    <h4>'.$row['video_title'].'</h4>
                    <p class="video_synopsis">'.nl2br($row['video_synopsis']).'</p>
                    <p> Réalisé par '.$row['user_username'].'</p>
                </section>
            </a>';
        }

    ?>

        <div class="horizontal_line omg_im_centered"></div>

        <h2 class="omg_im_centered">Membres</h2>
        <?php
        $query = "SELECT * FROM users WHERE user_username LIKE '%$research%';";

        $stmt = $db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            echo '<a href="profil.php?id='.$row['user_id'].'" class="result omg_im_centered">
                <img src="database/profile_pictures/'.$row["user_profile_picture"] . '" alt=""  class="profile_picture">

                <section>
                    <h4>'.$row['user_username'].'</h4>
                    
                    <p class="profile_description">'.$row['user_name'].'</p>
                </section>
            </a>';
        };
    ?>
    </main>
    <?php
    require('ressources/footer.php');
?>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>

</body>

</html>