<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    include('assets/php/config.php');
    include("ressources/pop_up_film_information.php");
    include("ressources/pop_up_connexion.php");
    include("ressources/pop_up_share.php");
    include('vimeo_setup.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv= »Content-Type » content= »text/html; charset=utf-8″ /> -->
    <title>REAH | Fil d'actualité</title>
    <link rel="icon" type="image/png" href="sources/img/reah_logo.png">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/fil_actu2.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <script src="assets/js/libraries/svg-inject-master/src/svg-inject.js"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
</head>

<body>

<?php
if(!isset($_GET['accueil'])){
 echo'

    <section class="accueil" id="accueil">

        <a class="accueil_reah_logo" href="fil_actu.php"></a>

        <img src="sources/img/accueil_img.png" class="accueil_img" alt="">

        <div class="accueil_text">
            <p class="h1">Bienvenue sur <nobr> REAH !</nobr>
            </p>
            <p>Viens stimuler ton esprit créatif en participant aux défis avec tes <nobr> court-métrages.</nobr> <br>
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
?>
    <main class="main_content">


        <!-- Navigation menu -->
        <nav>

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> </a>

            <div class="menu_nav">
                <!-- Categories's title -->
                <div class="menu_category">
                    <p class="category_title category_title1" number="1" number1="2" number2="3">Nouveautés</p>
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
                    if(func::checkLoginState($db)){ # If the user is connected
                        $query = "SELECT * FROM `users` WHERE user_id = ".$_COOKIE['userid'].";";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
    
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                        echo "<div class='menu_profile'>
                        <!-- Defi icon -->
                        <a href='defis.php' class='defi_icon'></a>
                        <!-- Profile photo -->
                        <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover'  class='menu_pp' onclick='toggleBurgerMenu()'></div>
                        </div>
                        </nav>";
    
                    } else {
    
                        echo "<div class='menu_profile'>
                        <!-- Defi icon -->
                        <a href='defis.php' class='defi_icon'></a>
                        <!-- Profile photo -->
                            <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'>
                            </div>
                        </div>
                        </nav>";
                    }
                ?>

                <!-- Category list  -->
                <div class="category_list_container">
                    <p class="category_list_category category_list_category1" number="1" number2="2" number3="3">Nouveautés</p>
                    <p class="category_list_category category_list_category2" number="2" number2="1" number3="3">Défis du moment</p>
                    <p class="category_list_category category_list_category3" number="3" number2="1" number3="2">Explorer</p>
                </div>

                <!-- Menu -->
                <?php
                    require("ressources/menu.php");
                ?>

                <!-- Nav footer -->

                <div class="nav_footer">
                    <div class="nav_footer_category" number="1" number2="2" number3="3">
                        <div class="nouveaute_icon"></div>
                        Nouveautés</div>
                    <div class="nav_footer_category" number="2" number2="1" number3="3">
                        <div class="defi_moment_icon"></div>
                        Défis du moment</div>
                    <div class="nav_footer_category" number="3" number2="1" number3="2">
                        <div class="explorer_icon"></div>
                        Explorer</div>
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
                                NOUVEAUTÉS
                            </h1>

                            <!-- All videos -->
                            <div class="all_video_container">

<?php

    $query = "SELECT * FROM `videos`";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $row){
        echo "<!-- Video container -->
        <div class='video_container'>

            <!-- Short film (class=video) -->
            <div class='video_content'>
            <iframe src='https://player.vimeo.com/video/".$row['video_vimeo_id']."' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
                <!-- Name + pp -->
                <div class='user_container'>

                <img src='data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . "' alt=''  class='pp_profile'>

                    <p class='pseudo'>".$row['user_username']."</p>
                    <div class='flou'></div>
                </div>

                <!-- Time -->
                <p class='time'>01:54</p>
            </div>

            <!-- Short film\'s informations -->
            <div class='description_container'>
                <div class='fb_jsb'>
                    <div class='synopsis_title_container' onclick='popupFilm($(this))' >
                        <h3 class='synopsis_title'>".$row['video_title']."</h3>
                        <p class='see_more'>Voir plus
                            <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                            </p>
                    </div>";
                    if(func::checkLoginState($db)){ # If the user is connected
                        echo"
                        <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>".$row['video_like_number']." J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupShare()'></div>

                        </div>";
                        } else { # If the user is an asshole
                            echo"
                            <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>".$row['video_like_number']." J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupConnexion()'></div>

                        </div>";
                        }

                    echo"
                </div>
                <p>".$row['video_synopsis']."</p>
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


                    <div class="second_category" id="category" number="2">

                        <!-- prev arrow -->
                        <div class="arrow_prev_container" onclick="prevArrowClick($(this))"></div>

                        <!-- Category content  -->
                        <div class="category_content">

                            <!-- Category title -->
                            <h1 class="title2" id="title2">
                                <div class="red_line title_line"></div>
                                DÉFIS DU MOMENT
                            </h1>

                            <!-- All videos -->
                            <div class="all_video_container">

<?php

    $query = "SELECT * FROM `videos`";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $row){
        echo "<!-- Video container -->
        <div class='video_container'>

            <!-- Short film (class=video) -->
            <div class='video_content'>
            <iframe src='https://player.vimeo.com/video/".$row['video_vimeo_id']."' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
                <!-- Name + pp -->
                <div class='user_container'>

                <img src='data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . "' alt=''  class='pp_profile'>

                    <p class='pseudo'>".$row['user_username']."</p>
                    <div class='flou'></div>
                </div>

                <!-- Time -->
                <p class='time'>01:54</p>
            </div>

            <!-- Short film\'s informations -->
            <div class='description_container'>
                <div class='fb_jsb'>
                    <div class='synopsis_title_container' onclick='popupFilm($(this))' >
                        <h3 class='synopsis_title'>".$row['video_title']."</h3>
                        <p class='see_more'>Voir plus
                            <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                            </p>
                    </div>";
                    if(func::checkLoginState($db)){ # If the user is connected
                        echo"
                        <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>".$row['video_like_number']." J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupShare()'></div>

                        </div>";
                        } else { # If the user is an asshole
                            echo"
                            <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>".$row['video_like_number']." J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupConnexion()'></div>

                        </div>";
                        }

                        echo"
                </div>
                <p>".$row['video_synopsis']."</p>
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

                    <div class="third_category" id="category" number="3">

                        <!-- prev arrow -->
                        <div class="arrow_prev_container" onclick="prevArrowClick($(this))"></div>

                        <!-- Category content  -->
                        <div class="category_content">

                            <!-- Category title -->
                            <h1 id="title3">
                                <div class="red_line title_line"></div>
                                EXPLORER
                            </h1>

                            <!-- All videos -->
                            <div class="all_video_container">

<?php
    $query = "SELECT * FROM `videos`";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $row){
        echo "<!-- Video container -->
        <div class='video_container'>

            <!-- Short film (class=video) -->
            <div class='video_content'>
            <iframe src='https://player.vimeo.com/video/".$row['video_vimeo_id']."' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
                <!-- Name + pp -->
                <div class='user_container'>

                <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover'  class='menu_pp' onclick='toggleBurgerMenu()'></div>

                <p class='pseudo'>".$row['user_username']."</p>
                    <div class='flou'></div>
                </div>

                <!-- Time -->
                <p class='time'>01:54</p>
            </div>

            <!-- Short film\'s informations -->
            <div class='description_container'>
                <div class='fb_jsb'>
                    <div class='synopsis_title_container' onclick='popupFilm($(this))'>
                        <h3 class='synopsis_title'>".$row['video_title']."</h3>
                        <p class='see_more'>Voir plus
                            <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                            </p>
                    </div>";

                    if(func::checkLoginState($db)){ # If the user is connected
                        echo"
                        <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>".$row['video_like_number']." J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupShare()'></div>

                        </div>";

                        } else { # If the user is an asshole
                            echo"
                            <div class='reaction_container'>
                            <div class='fb_jsb like_container'>
                                <!-- Pop corn image -->
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>".$row['video_like_number']." J'aime</p>
                            </div>
                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='share_icon' onclick='popupConnexion()'></div>

                        </div>";
                        }

                        echo"
                </div>
                <p>".$row['video_synopsis']."</p>
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

    </main>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/fil_actu.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>