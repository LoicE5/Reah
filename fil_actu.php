<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
include('assets/php/config.php');
// include("ressources/pop_up_film_information.php");
include("ressources/pop_up_connexion.php");
// include("ressources/pop_up_share.php");
include('assets/php/comments.php');


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv= »Content-Type » content= »text/html; charset=utf-8″ /> -->
    <title>REAH | Fil d'actualité</title>
    <link rel="stylesheet" href="assets/css/profil.css">
    <link rel="stylesheet" href="assets/css/defis.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/fil_actu2.css">
    <link rel="apple-touch-icon" sizes="180x180" href="sources/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="sources/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="sources/img/favicon/favicon-16x16.png">
<link rel="manifest" href="sources/img/favicon/site.webmanifest">
<link rel="mask-icon" href="sources/img/favicon/safari-pinned-tab.svg" color="#d60036">
<meta name="msapplication-TileColor" content="#2b5797">
<meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <script src="assets/js/libraries/svg-inject-master/src/svg-inject.js"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
</head>

<body>

    <!-- Accueil -->
    <?php
    if (!isset($_GET['accueil'])) {
    if (!isset($_GET['comment_send'])) {

        echo '

    <section class="accueil" id="accueil">

        <a class="accueil_reah_logo" href="fil_actu.php"></a>

        <img src="sources/img/accueil_img.png" class="accueil_img" alt="">

        <div class="accueil_text">
            <p class="h1">Bienvenue sur <nobr> REAH !</nobr>
            </p>
            <p>Stimule ton esprit créatif en participant aux défis avec tes <nobr> courts-métrages.</nobr> <br>
                Tente ta chance de te faire connaître ou contribue au succès des autres. <br> <br> <b> Réalisateurs,
                    amateurs ou <nobr> débutants ? </nobr> <br> À vos marques, prêt·e·s, <span>tournez !</span> </b></p>
            <div class="btn_container">
                <a href="login.php" class="btn btn_connexion">Se connecter</a>
                <a href="signup.php" class="btn btn_connexion">S\'inscrire</a>
            </div>
        </div>
        <img src="sources/img/accueil_arrow.svg" class="scroll_arrow" alt="">

    </section>';
    }
}
    ?>
    <main class="main_content">


    <!-- Signalement -->
    <?php
    if (isset($message_true)) {
        echo '
        <p class="message_true_container">
                '.$message_true.'
        </p>';
    }

    if (isset($_GET['delete_account'])) {
        echo '<p class="message_true_container">Votre compte a bien été supprimé.</p>';
    }
    ?>


        <!-- Navigation menu -->
        <nav>

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> </a>

            <div class="menu_nav">
                <!-- Categories's title -->
                <div class="menu_category">
                    <p class="category_title category_title1" number="1" number1="2" number2="3">
                    <?php
                    if (func::checkLoginState($db)) { #If the user is connected
                        echo 'Fil d\'actualité';
                    } else {
                        echo 'Nouveautés';
                    }
                    ?>    
                    </p>
                    <p class="category_title category_title2" number="2" number1="1" number2="3">Défis du moment</p>
                    <p class="category_title category_title3" number="3" number1="1" number2="2">Explorer</p>
                    <div class="red_line underline"></div>
                    <div class="fb_jsb ai-c category_list">
                        <p class="category_list_title">Catégories</p>
                        <div class="category_triangle"></div>
                    </div>
                </div>


                <!-- Search bar -->
                <form action="search.php" method="GET" class="form_search_bar">
                    <input class="search_bar" name="research" type="text"
                        placeholder="Défis, courts-métrages, utilisateurs..." oninput="searchEngine(this.value)">
                </form>

                <?php
                if (func::checkLoginState($db)) { # If the user is connected
                    $query = "SELECT * FROM `users` WHERE user_id = " . $_COOKIE['userid'] . ";";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo "<div class='menu_profile'>
                        <!-- Defi icon -->
                        <a href='defis.php' class='defi_icon'></a>
                        <!-- Profile photo -->
                        <img src='database/profile_pictures/".$row['user_profile_picture']."' class='menu_pp' onclick='toggleBurgerMenu()'>";
                } else {

                    echo "<div class='menu_profile'>
                        <!-- Defi icon -->
                        <a href='defis.php' class='defi_icon'></a>
                        <!-- Profile photo -->
                            <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'>
                            </div>";
                }
                ?>
            </div>
        </nav>

        <!-- Category list  -->
        <div class="category_list_container">
            <p class="category_list_category category_list_category1" number="1" number2="2" number3="3">
            <?php
                    if (func::checkLoginState($db)) { #If the user is connected
                        echo 'Fil d\'actualité';
                    } else {
                        echo 'Nouveautés';
                    }
                    ?>
            </p>
            <p class="category_list_category category_list_category2" number="2" number2="1" number3="3">
                Défis du moment</p>
            <p class="category_list_category category_list_category3" number="3" number2="1" number3="2">
                Explorer</p>
        </div>

        <!-- Menu -->
        <?php require("ressources/menu.php"); ?>

        <!-- Nav footer -->

        <div class="nav_footer">
            <div class="nav_footer_category" number="1" number2="2" number3="3">
                <div class="nouveaute_icon"></div>
                <?php
                    if (func::checkLoginState($db)) { #If the user is connected
                        echo 'Fil d\'actualité';
                    } else {
                        echo 'Nouveautés';
                    }
                    ?>
            </div>
            <div class="nav_footer_category" number="2" number2="1" number3="3">
                <div class="defi_constraints_icon"></div>
                Défis du moment
            </div>
            <div class="nav_footer_category" number="3" number2="1" number3="2">
                <div class="explorer_icon"></div>
                Explorer
            </div>
        </div>



        <div class="all_category_container">


            <!-- "Ajout récent" catégory -->
            <div class="first_category" id="category" number="1">

                <!-- prev arrow -->
                <div class="arrow_prev_container" onclick="prevArrowClick($(this))"></div>

                <!-- Category content  -->
                <div class="category_content">

                    <!-- Category title -->
                    <h1 id="title1">
                        <div class="red_line title_line"></div>
                        <?php

                        if (func::checkLoginState($db)) { #If the user is connected
                            echo"
                                FIL D'ACTUALITÉ
                                <div class='help_icon_container'>
                            <img src='sources/img/help_icon.png' alt='' class='help_icon'>
                            <p class='help_message'>La catégorie \"Fil d'actualité\" présente tous les courts-métrages de tes abonnements.</p>
                        </div>";
                        }else {
                            echo"
                                NOUVEAUTÉS
                                <div class='help_icon_container'>
                            <img src='sources/img/help_icon.png' alt='' class='help_icon'>
                            <p class='help_message'>La catégorie \"Nouveautés\" présente tous les courts-métrages récemment déposés.</p>
                        </div>";
                        }
                        ?>
                    </h1>

                    <!-- All videos -->
                    <div class="all_video_container" id="all_video_container">

                        <?php

                if (func::checkLoginState($db)) { # If the user is connected

                        $user_id = $_COOKIE['userid'];
                        $query = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM `videos`, `users`, `subscription` WHERE user_id = video_user_id AND subscription_subscriber_id = $user_id AND subscription_artist_id = user_id ORDER BY video_id DESC";
                        $stmt = $db->prepare($query);
                        $stmt->execute();

                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($rows as $row) {
                            echo "<!-- Video container -->
        <div class='video_container'>

            <!-- Short film (class=video) -->
            <div class='video_content'>";
            if($row['video_poster'] != ''){
                echo"
                <img src='database/videos_posters/".$row['video_poster']."' class='video_poster'>";
            }

            echo"
            <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
                <!-- Name + pp -->
                <a href='profil.php?id=" . $row['user_id'] . "' class='user_container'>

                <img src='database/profile_pictures/".$row['user_profile_picture'] . "' alt=''  class='pp_profile'>

                    <p class='pseudo'>" . $row['user_username'] . "</p>
                    <div class='flou'></div>
                </a>

                <!-- Time -->
                <p class='time'>" . $row['time'] . "</p>
            </div>

            <!-- Short film\'s informations -->
            <div class='description_container'>
                <div class='fb_jsb'>
                    <div class='synopsis_title_container' title=" . $row['video_id'] . " onclick='popupFilm(this)' >
                        <h3 class='synopsis_title'>" . $row['video_title'] . "</h3>
                        <p class='see_more'>Voir plus
                            <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                            </p>
                    </div>
                    
                        <div class='reaction_container'>
                            <div class='fb_jsb like_container'>";

                                // <!-- Pop corn image -->

                                $query10 = "SELECT COUNT(*) as nbr FROM liked WHERE liked_user_id={$_COOKIE['userid']} AND liked_video_id={$row['video_id']}";
                                $stmt10 = $db->prepare($query10);
                                $stmt10->execute();

                                $row10 = $stmt10->fetch(PDO::FETCH_ASSOC);

                                if ($row10['nbr'] >= 1) {
                                    echo"
                                    <img src='sources/img/pop_corn.png' class='pop_corn_icon' onclick='addLike(this)'>";
                                } else {
                                    echo"
                                    <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='addLike(this)'>";
                                }

                                echo"
                                <!-- Like\'s number -->
                                <p class='pop_corn_number' title='".$row["video_id"]."' onclick='popupUserLike(this)'>" . $row['video_like_number'] . " J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupComment(this)' >
                                <div class='comment_icon'></div>";

                                // Comment's number
                                $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                                $stmt2 = $db->prepare($query2);
                                $stmt2->execute();

                                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                echo "
                                        <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                                echo "
                                        </div>
                            <!-- Share icon -->
                            <div class='share_icon' title=".$row['video_id']." onclick='popupShare(this)'></div>

                        </div>";
                           

                            echo "
                </div>
                <p>" . nl2br($row['video_synopsis']) . "</p>
            </div>


        </div>";
                        }
                    } else {
                        $query = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM `videos`, `users` WHERE user_id = video_user_id ORDER BY video_id DESC";
                        $stmt = $db->prepare($query);
                        $stmt->execute();

                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($rows as $row) {
                            echo "<!-- Video container -->
        <div class='video_container'>
        <!-- Short film (class=video) -->
            <div class='video_content'>";
            if($row['video_poster'] != ''){
                echo"
                <img src='database/videos_posters/".$row['video_poster']."' class='video_poster'>";
            }

            echo"
            <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
                <!-- Name + pp -->
                <a href='profil.php?id=" . $row['user_id'] . "' class='user_container'>

                <img src='database/profile_pictures/".$row['user_profile_picture'] . "' alt=''  class='pp_profile'>

                    <p class='pseudo'>" . $row['user_username'] . "</p>
                    <div class='flou'></div>
                </a>

                <!-- Time -->
                <p class='time'>" . $row['time'] . "</p>
            </div>

            <!-- Short film\'s informations -->
            <div class='description_container'>
                <div class='fb_jsb'>
                    <div class='synopsis_title_container' title=" . $row['video_id'] . " onclick='popupFilm(this)' >
                        <h3 class='synopsis_title'>" . $row['video_title'] . "</h3>
                        <p class='see_more'>Voir plus
                            <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                            </p>
                    </div>";
                            if (func::checkLoginState($db)) { # If the user is connected
                                echo "
                        <div class='reaction_container'>
                            <div class='fb_jsb like_container'>";

                                // <!-- Pop corn image -->

                                $query10 = "SELECT COUNT(*) as nbr FROM liked WHERE liked_user_id={$_COOKIE['userid']} AND liked_video_id={$row['video_id']}";
                                $stmt10 = $db->prepare($query10);
                                $stmt10->execute();

                                $row10 = $stmt10->fetch(PDO::FETCH_ASSOC);

                                if ($row10['nbr'] >= 1) {
                                    echo"
                                    <img src='sources/img/pop_corn.png' class='pop_corn_icon' onclick='addLike(this)'>";
                                } else {
                                    echo"
                                    <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='addLike(this)'>";
                                }

                                echo"
                                <!-- Like\'s number -->
                                <p class='pop_corn_number' title='".$row["video_id"]."' onclick='popupUserLike(this)'>" . $row['video_like_number'] . " J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupComment($(this))' >
                                <div class='comment_icon'></div>";

                                // Comment's number
                                $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                                $stmt2 = $db->prepare($query2);
                                $stmt2->execute();

                                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                echo "
                                        <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                                echo "
                                        </div>
                            <!-- Share icon -->
                            <div class='share_icon' title=".$row['video_id']." onclick='popupShare(this)'></div>

                        </div>";
                            } else { # If the user is an asshole
                                echo "
                            <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number' title='".$row["video_id"]."' onclick='popupUserLike(this)'>" . $row['video_like_number'] . " J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupConnexion()' >
                                <div class='comment_icon'></div>";

                                // Comment's number
                                $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                                $stmt2 = $db->prepare($query2);
                                $stmt2->execute();

                                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                echo "
                                        <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                                echo "
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupConnexion()'></div>

                        </div>";
                            }

                            echo "
                </div>
                <p>" . nl2br($row['video_synopsis']) . "</p>
            </div>


        </div>";
                    }
                }

                        $stmt = null;
                        $query = null;
                        $rows = null;

                        ?>


                    </div>
                </div>



                <!-- next arrow -->
                <div class="arrow_next_container" onclick="nextArrowClick($(this))"></div>

            </div>


            <div class="second_category" id="category" number="2">


                <!-- Category content  -->
                <div class="category_content">

                    <!-- Category title -->
                    <h1 class="title2" id="title2">
                        <div class="red_line title_line"></div>
                        DÉFIS DU MOMENT
                        <div class='help_icon_container'>
                            <img src='sources/img/help_icon.png' alt='' class='help_icon'>
                            <p class='help_message'>La catégorie "Défis du moment" présente les deux défis auxquels tu peux participer. Les défis du moment changent tous les mois.</p>
                        </div>
                        <a href="defis.php" class="see_defis"><div class="defi_icon"></div>Voir tous les défis</a>
                    </h1>

                    <!-- Challenges container -->
            <div class="defi_container ">

<?php
$query = "SELECT * FROM defis WHERE defi_verified='1' AND defi_current='1'";
$stmt = $db->prepare($query);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($rows as $row) {
    echo '
        <a href="defi_details.php?defi=' . $row['defi_id'] . '" class="defi_content">
        <img src="database/defis_img/'.$row['defi_image'].'" alt="" class="defi_img defi1_img">
        <p class="defi_time">Temps restant : <span id="time" time='.$row['defi_date_end'].'></span></p>
    </a>';
}
?>
<!--  -->
</div>
<a href="defis.php" class="see_defis2"><div class="defi_icon"></div>Voir tous les défis</a>

                </div>
                

            </div>

            <div class="third_category" id="category" number="3">

                <!-- prev arrow -->
                <div class="arrow_prev_container" onclick="prevArrowClick($(this))"></div>

                <!-- Category content  -->
                <div class="category_content">

                    <!-- Category title -->
                    <h1 id="title3">
                        <div class="red_line title_line"></div>
                        EXPLORER
                        <div class="help_icon_container">
                            <img src="sources/img/help_icon.png" alt="" class="help_icon">
                            <p class="help_message">La catégorie "Explorer" présente tous les courts-métrages déposés sur REAH.</p>
                        </div>
                    </h1>

                    <!-- All videos -->
                    <div class="all_video_container">

                        <?php
                        $query = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM `videos`, `users` WHERE user_id = video_user_id ORDER BY RAND()";
                        $stmt = $db->prepare($query);
                        $stmt->execute();

                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($rows as $row) {
                            echo "<!-- Video container -->
        <div class='video_container'>

            <!-- Short film (class=video) -->
            <div class='video_content'>";
            if($row['video_poster'] != ''){
                echo"
                <img src='database/videos_posters/".$row['video_poster']."' class='video_poster'>";
            }

            echo"
            <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
                <!-- Name + pp -->
                <a href='profil.php?id=" . $row['user_id'] . "' class='user_container'>

                <img src='database/profile_pictures/".$row['user_profile_picture'] . "' alt=''  class='pp_profile'>


                <p class='pseudo'>" . $row['user_username'] . "</p>
                    <div class='flou'></div>
                </a>

                <!-- Time -->
                <p class='time'>" . $row['time'] . "</p>
            </div>

            <!-- Short film\'s informations -->
            <div class='description_container'>
                <div class='fb_jsb'>
                    <div class='synopsis_title_container' title=" . $row['video_id'] . " onclick='popupFilm(this)'>
                        <h3 class='synopsis_title'>" . $row['video_title'] . "</h3>
                        <p class='see_more'>Voir plus
                            <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                            </p>
                    </div>";

                            if (func::checkLoginState($db)) { # If the user is connected
                                echo "
                        <div class='reaction_container'>
                            <div class='fb_jsb like_container'>";

                                // <!-- Pop corn image -->

                                $query10 = "SELECT COUNT(*) as nbr FROM liked WHERE liked_user_id={$_COOKIE['userid']} AND liked_video_id={$row['video_id']}";
                                $stmt10 = $db->prepare($query10);
                                $stmt10->execute();

                                $row10 = $stmt10->fetch(PDO::FETCH_ASSOC);

                                if ($row10['nbr'] >= 1) {
                                    echo"
                                    <img src='sources/img/pop_corn.png' class='pop_corn_icon' onclick='addLike(this)'>";
                                } else {
                                    echo"
                                    <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='addLike(this)'>";
                                }

                                echo"
                                <!-- Like\'s number -->
                                <p class='pop_corn_number' title='".$row["video_id"]."' onclick='popupUserLike(this)'>" . $row['video_like_number'] . " J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupComment(this)' >
                                <div class='comment_icon'></div>";

                                // Comment's number
                                $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                                $stmt2 = $db->prepare($query2);
                                $stmt2->execute();

                                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                echo "
                                        <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                                echo "
                                        </div>
                            <!-- Share icon -->
                            <div class='share_icon' title=".$row['video_id']." onclick='popupShare(this)'></div>

                        </div>";
                            } else { # If the user is an asshole
                                echo "
                            <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number' title='".$row["video_id"]."' onclick='popupUserLike(this)'>" . $row['video_like_number'] . " J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupConnexion(this)' >
                                <div class='comment_icon'></div>";

                                // Comment's number
                                $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                                $stmt2 = $db->prepare($query2);
                                $stmt2->execute();

                                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                echo "
                                        <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";
                                echo "
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupConnexion()'></div>

                        </div>";
                            }

                            echo "
                </div>
                <p>" . nl2br($row['video_synopsis']) . "</p>
            </div>


        </div>";
                        }

                        $stmt = null;
                        $query = null;
                        $rows = null;

                        ?>
                    </div>
                </div>

                <!-- next arrow -->
                <div class="arrow_next_container" onclick="nextArrowClick($(this))"></div>
            </div>

        </div>

        <?php
        require("ressources/footer.php");
        ?>

    <div class='dark_filter dark_filter_film_data' onclick="closePopupFilm(this)"></div>
    <div class="share_dark_filter" onclick="closePopupShare()"></div>
    <div class="like_dark_filter" onclick="closePopupUserLike()"></div>
    <div class="delete_dark_filter" onclick="closePopupDeleteFilm()"></div>


    </main>


    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/fil_actu.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
    <!-- <script>console.log('bite');</script> -->
</body>

</html>