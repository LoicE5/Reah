<?php
    include('assets/php/config.php');
?>
<?php
    if(!func::checkLoginState($db)){ # If the user isn't connected
        redirect('login.php');
    } else {
        $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Profil</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/saved.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/fullpage.css" />
    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/functions.js" defer></script>
    <script src="assets/js/fil_actu.js" defer></script>

    <style>

        .main_content{
            display:block;
        }
    </style>
</head>

<body>
    <main class="main_content">

        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a href="fil_actu.php" class="reah_logo"></a>

            <!-- Search bar -->
            <form action="search.php" method="GET" class="form_search_bar">
                    <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs..." oninput="searchEngine(this.value)">
                </form>


            <?php
                 if(func::checkLoginState($db)){ # If the user is connected
                    $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
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
                        </div>
                    </nav>";

                } else {
                    redirect('login.php');
                }
            ?>
        </nav>

        <!-- Menu -->
        <?php
            require("ressources/menu.php");
        ?>

<h2 class="omg_im_centered">Courts-métrages enregistrés</h2>

<div id="saved_container"> 
        <?php
        $research = htmlspecialchars($_GET['research']);

        # Non définitif, la requête finale incluera l'ensemble des tables.
        # Se référer au modèle conceptuel sur le drive
        $query = "SELECT * FROM videos, users, saved WHERE saved_user_id = user_id AND saved_video_id = video_id";

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

        </div>

        </main>

    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
</body>
</html>