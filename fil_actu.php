<?php
    require("header.php");
    require("pop_up_film_information.php");
    require("pop_up_connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Fil d'actu</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/fil_actu.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <main class="main_content">


        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> <img src="public/sources/img/logo_reah.svg" alt=""></a>
            <!-- Categories's title -->
            <div class="menu_category">
                <p class="category_title category_title1" number="1" number1="2" number2="3">Ajouts récents</p>
                <p class="category_title category_title2" number="2" number1="1" number2="3">Défis du moment</p>
                <p class="category_title category_title3" number="3" number1="1" number2="2">À découvrir</p>
                <div class="underline"></div>
                <div class="fb_jsb ai-c category_list">
                    <p class="category_list_title">Catégories</p>
                    <div class="category_triangle"></div>
                </div>
            </div>


            <!-- Search bar -->
            <form action="" class="form_search_bar">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
            </form>

            <div class="menu_profile">
                <!-- Defi icon -->
                <a href="defis.php"> <img src="public/sources/img/defi_icon.svg" class="defi_icon" alt=""></a>
                <!-- Profile photo -->
                <img src="public/sources/img/pdp.jpg" class="menu_pp" alt="">
            </div>
        </nav>

        <!-- Category list  -->
        <div class="category_list_container">
            <p class="category_list_category" number="1" number1="2" number2="3">Ajouts récents</p>
            <p class="category_list_category" number="2" number1="1" number2="3">Défis du moment</p>
            <p class="category_list_category" number="3" number1="1" number2="2">À découvrir</p>
        </div>

        <!-- Menu -->
        <div class="menu_container">

            <!-- Profile -->
            <a href="profil.php" class="menu_option profil">
                <img src="public/sources/img/profile_icon.svg" alt="">
                <p class="menu_option_title">Profil</p>
            </a>

            <!-- Notifications -->
            <a href="" class="menu_option notifications">
                <img src="public/sources/img/notifications_icon.svg" alt="">
                <p class="menu_option_title">Notifications</p>
            </a>

            <a href="" class="registered menu_option">
                <img src="public/sources/img/saved_icon.svg" alt="">
                <p class="menu_option_title">Enregistrés</p>
            </a>
            <a href="" class="settings menu_option">
                <img src="public/sources/img/settings_icon.svg" alt="">
                <p class="menu_option_title">Paramètres</p>
            </a>
            <a href="connexion.php" class="disconnection menu_option">
                <img src="public/sources/img/disconnection_icon.svg" alt="">
                <p class="menu_option_title">Déconnexion</p>
            </a>
        </div>


        <!-- "Ajout récent" catégory -->
        <div class="first_category">

            <!-- prev arrow -->
            <div class="arrow_prev_container fp-controlArrow fp-prev">
                <!-- Arrow -->
                <img src="public/sources/img/prev_arrow.svg" class="prev_arrow" alt="">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1>AJOUTS RÉCENTS</h1>

                <!-- All videos -->
                <div class="all_video_container">

                    <?php
                    $requete="SELECT title,username,url,DATE_FORMAT(duration, '%imin %s' ) AS duration,synopsis,poster,photo FROM re_films, re_users, re_a_realise WHERE id_films=realise_ext_films AND id_users=realise_ext_users";
                    $stmt=$db->query($requete);
                    $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach($resultat as $films){
                        echo "

                    <!-- Video container -->
                    <div class='video_container'>

                        <!-- Short film -->
                        <div class='video_content'>
                            <video class='video' poster='{$films["poster"]}' muted>
                                <source src='{$films["url"]}' type='video/mp4'>
                            </video>
                            <!-- Name + pp -->
                            <div class='user_container'>
                                <img src='{$films["photo"]}' class='pp_profile' alt=''>
                                <p class='pseudo'>{$films["username"]}</p>
                                <div class='flou'></div>
                            </div>

                            <!-- Time -->
                            <p class='time'>{$films["duration"]}</p>
                        </div>

                        <!-- Short film\'s informations -->
                        <div class='description_container'>
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container' >
                                    <h3 class='synopsis_title'>{$films["title"]}</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                </div>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c'>
                                        <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>

                                </div>
                            </div>
                            <p>{$films["synopsis"]}</p>
                        </div>


                    </div>
                    
                    ";
                }

                ?>


                </div>
            </div>



            <!-- next arrow -->
            <div class="arrow_next_container fp-controlArrow fp-next">
                <!-- Arrow -->
                <img src="public/sources/img/next_arrow.svg" class="next_arrow" alt="">
            </div>

        </div>


        <div class="second_category">

            <!-- prev arrow -->
            <div class="arrow_prev_container">
                <!-- Arrow -->
                <img src="public/sources/img/prev_arrow.svg" class="prev_arrow" alt="">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1 class="title2">DÉFIS DU MOMENT</h1>

                <!-- All videos -->
                <div class="all_video_container">

                    <?php
                    $requete="SELECT title,username,url,DATE_FORMAT(duration, '%imin %s' ) AS duration,synopsis,poster,photo FROM re_films, re_users, re_a_realise WHERE id_films=realise_ext_films AND id_users=realise_ext_users";
                    $stmt=$db->query($requete);
                    $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach($resultat as $films){
                        echo "

                    <!-- Video container -->
                    <div class='video_container'>

                        <!-- Short film -->
                        <div class='video_content'>
                            <video class='video' poster='{$films["poster"]}' muted>
                                <source src='{$films["url"]}' type='video/mp4'>
                            </video>
                            <!-- Name + pp -->
                            <div class='user_container'>
                                <img src='{$films["photo"]}' class='pp_profile' alt=''>
                                <p class='pseudo'>{$films["username"]}</p>
                                <div class='flou'></div>
                            </div>

                            <!-- Time -->
                            <p class='time'>{$films["duration"]}</p>
                        </div>

                        <!-- Short film\'s informations -->
                        <div class='description_container'>
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container' >
                                    <h3 class='synopsis_title'>{$films["title"]}</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                </div>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c'>
                                        <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                        <p class='profile_comment_title'>1 925 commentaires</p>
                                    </div>

                                    <!-- Share icon -->
                                    <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>

                                </div>
                            </div>
                            <p>{$films["synopsis"]}</p>
                        </div>


                    </div>
                    
                    ";
                }

                ?>

                </div>
            </div>

            <!-- next arrow -->
            <div class="arrow_next_container">
                <!-- Arrow -->
                <img src="public/sources/img/next_arrow.svg" class="next_arrow" alt="">
            </div>
        </div>

        <div class="third_category">

            <!-- prev arrow -->
            <div class="arrow_prev_container">
                <!-- Arrow -->
                <img src="public/sources/img/prev_arrow.svg" class="prev_arrow" alt="">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1>À DÉCOUVRIR</h1>

                <!-- All videos -->
                <div class="all_video_container">

                    <?php
                    $requete="SELECT title,username,url,DATE_FORMAT(duration, '%imin %s' ) AS duration,synopsis,poster,photo FROM re_films, re_users, re_a_realise WHERE id_films=realise_ext_films AND id_users=realise_ext_users";
                    $stmt=$db->query($requete);
                    $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach($resultat as $films){
                        echo "

                    <!-- Video container -->
                    <div class='video_container'>

                        <!-- Short film -->
                        <div class='video_content'>
                            <video class='video' poster='{$films["poster"]}' muted>
                                <source src='{$films["url"]}' type='video/mp4'>
                            </video>
                            <!-- Name + pp -->
                            <div class='user_container'>
                                <img src='{$films["photo"]}' class='pp_profile' alt=''>
                                <p class='pseudo'>{$films["username"]}</p>
                                <div class='flou'></div>
                            </div>

                            <!-- Time -->
                            <p class='time'>{$films["duration"]}</p>
                        </div>

                        <!-- Short film\'s informations -->
                        <div class='description_container'>
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container' >
                                    <h3 class='synopsis_title'>{$films["title"]}</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                </div>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c'>
                                        <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                        <p class='profile_comment_title'>1 925 commentaires</p>
                                    </div>

                                    <!-- Share icon -->
                                    <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>

                                </div>
                            </div>
                            <p>{$films["synopsis"]}</p>
                        </div>


                    </div>
                    
                    ";
                }

                ?>
                </div>
            </div>

            <!-- next arrow -->
            <div class="arrow_next_container">
                <!-- Arrow -->
                <img src="public/sources/img/next_arrow.svg" class="next_arrow" alt="">
            </div>
        </div>
    </main>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <!-- <script src="public/assets/js/register.js"></script> -->
    <script src="public/assets/js/fil_actu.js"></script>
</body>

</html>