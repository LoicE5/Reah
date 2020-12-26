<?php
    require("header.php");
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Fil d'actu</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/fil_actu.css">
    <link rel="stylesheet" href="public/assets/css/profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/assets/css/fullpage.css" />

</head>

<body>
    <main class="main_content">


        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> <img src="public/sources/img/logo_reah.svg" alt=""></a>
            <!-- Categories's title -->
            <div class="menu_category">
                <p class="category_title category_title1" number="1" number1="2" number2="3">Défis du moment</p>
                <p class="category_title category_title2" number="2" number1="1" number2="3">Défis populaires</p>
                <p class="category_title category_title3" number="3" number1="1" number2="2">Défis à découvrir</p>
                <div class="underline"></div>
            </div>

            <!-- Search bar -->
            <form action="">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
            </form>

            <div class="menu_profile">
                <!-- Home icon -->
                <a href="fil_actu.php"> <img src="public/sources/img/fil_actu_icon.svg" class="defi_icon" alt=""></a>
                <!-- Challenge icon -->
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
            <a href="connexion.php" class="menu_option sign_in">Se connecter</a>
            <a href="public/index.php" class="menu_option sign_up">S'inscrire</a>

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
            <a href="" class="disconnection menu_option">
                <img src="public/sources/img/disconnection_icon.svg" alt="">
                <p class="menu_option_title">Déconnexion</p>
            </a>
        </div>

        <div class="banner_container">
            <div class="banner_flou_left"></div>
            <div class="banner"></div>
            <div class="banner_flou_right"></div>
        </div>

        <div class="profile_container">

            <div class="fb_jsa profile_content1">
                <!-- Subscription section -->
                <div class="fb_jsb profile_subscription_container">
                    <div class="profile_subscription_content">
                        <p class="fb profile_subscription_number">1213</p>
                        <div class="profile_subscription_line"></div>
                        <p class="profile_subscription_title">Abonnés</p>
                    </div>

                    <div class="profile_subscription_content">
                        <p class="fb profile_subscription_number">2000</p>
                        <div class="profile_subscription_line"></div>
                        <p class="profile_subscription_title">Abonnements</p>
                    </div>
                </div>
                <!-- Profile photo + username -->
                <img src="public/sources/img/profile_photo/minmin.jpg" alt="" class="profile_photo">
            </div>

            <div class="fb_jsb profile_content2">
                <div class="fb profile_bio_container">
                    <p class="profile_username">MinminDddddddddddddddd</p>
                    <div class="profile_line"></div>
                    <p class="profile_name">Minal Lad</p>
                    <p class="profile_bio">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem
                        <br>
                        laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d <br><br><br> olor,
                        voluptatem recusandae
                        <br>
                        assumenda rerum facereeee</p>

                </div>
                <img src="public/sources/img/modify_icon.svg" class="modify_icon" alt="">
            </div>
        </div>

        <!-- Realisations's number -->

        <div class="fb_jc realisation_number_container">
            <div class="fb_jsb realisation_number_content">
                <p class="realisation_number_content_title realisation_number_content_title1" number="2"><span
                        class="realisation_number_content_number ">2</span> réalisations </p>
                <p class="realisation_number_content_title realisation_number_content_title2" number="1"><span
                        class="realisation_number_content_number">8</span> identifiés </p>
                <div class="realisation_number_content_line"></div>
            </div>
        </div>


        <!-- All realisations -->
        <div class="all_realisation_container">

            <!-- Realisations's videos -->
            <div class="realisation_container">

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

                        <!-- Time -->
                        <p class='time'>{$films["duration"]}</p>
                    </div>

                    <!-- Short film\'s informations -->
                    <div class='description_container'>
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
                            <div class='fb_jsb share_container'>
                                <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>
                                <p class='share_title'>Partager</p>
                            </div>
                        </div>

                        <div class='fb_c_jsb'>
                            <div class='synopsis_title_container' >
                                <h3 class='synopsis_title'>{$films["title"]}</h3>
                                <p class='see_more'>Voir plus
                                <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                </p>
                            </div>
                    
                        <p>{$films["synopsis"]}</p>


                        </div>
                    </div>


                </div>

                ";
                }

                ?>
            </div>

            <!-- Identified's videos -->
            <div class="identified_container">

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
                        <div class='fb_jsb share_container'>
                            <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>
                            <p class='share_title'>Partager</p>
                        </div>
                    </div>

                    <div class='fb_c_jsb'>
                        <div class='synopsis_title_container' >
                            <h3 class='synopsis_title'>{$films["title"]}</h3>
                            <p class='see_more'>Voir plus
                            <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                            </p>
                        </div>
                
                    <p>{$films["synopsis"]}</p>


                    </div>
                </div>


            </div>

            ";
            }

            ?>
            </div>
        </div>
    </main>


    <!-- Films'informations -->

    <div class='dark_filter'></div>
    <?php

                    $requete="SELECT re_films.title as title, re_challenges.title AS challenge, GROUP_CONCAT(username SEPARATOR ', ') AS distribution, url, DATE_FORMAT(duration, '%imin %s' ) AS duration, synopsis, poster, DATE_FORMAT(re_films.date, '%d/%m/%Y') AS date, GROUP_CONCAT(name SEPARATOR ', ') AS genre FROM re_films, re_users, re_a_realise, re_possede, re_genres, re_challenges WHERE id_films=realise_ext_films AND id_users=realise_ext_users AND possede_ext_films=id_films AND possede_ext_genres=id_genres AND id_films='1'";
                    $stmt=$db->query($requete);
                    $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach($resultat as $films){

                        echo "
                        <div class='film_container'>
                        <div class='fb_c'>
                            <div class='film_header'>
                                <p class='film_title'>{$films["title"]}</p>
                                <img src='public/sources/img/close_icon.svg' class='close_icon' alt=''>
                            </div>
                    
                            <!-- Film -->
                            <video class='film' poster='{$films["poster"]}' muted>
                                <source src='{$films["url"]}' type='video/mp4'>
                            </video>
                    
                    
                            <div class='film_informations'>
                    
                                <div class='fb_jsb'>
                                    <div class='fb_jsb'>
                    
                                        <!-- Challenge section -->
                                        <div class='fb challenge_container'>
                                            <img src='public/sources/img/defi_icon.svg' class='challenge_defi_icon' alt=''>
                                            <a href='defi1.php' class='challenge_title'>{$films["challenge"]}</a>
                                        </div>
                                        <p class='film_time'>{$films["duration"]}</p>
                                        <p class='film_date'>{$films["date"]}</p>
                                    </div>
                    
                                    <div class='fb_jsb'>
                    
                                        <!-- Like section -->
                                        <div class='fb_jsb'>
                                            <img class='pop_corn_icon' src='public/sources/img/pop_corn_icon.svg' alt=''>
                                            <p class='film_pop_corn_number'>515 J'aime</p>
                                        </div>
                    
                                        <!-- Share section -->
                                        <div class='fb_jsb share_container'>
                                            <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>
                                            <p class='share_title'>Partager</p>
                                        </div>
                                    </div>
                                </div>
                    
                                <p class='film_description'>{$films["synopsis"]}</p>
                    
                                <div class='fb_jsa'>
                                    <p class='genre_container'><span>Genres</span> <br> {$films["genre"]}</p>
                                    <p class='distribution_container'><span>Distribution</span> <br> {$films["distribution"]}</p>
                                </div>
                    
                            </div>
                            <div class='fb_jc ai-c comment_title_container'>
                                <img src='public/sources/img/comment_icon.svg' class='reaction_icons' alt=''>
                                <p class='comment_title'>25 commentaires</p>
                                <img src='public/sources/img/bottom_arrow.svg' class='comment_arrow' alt=''>
                            </div>
                        </div>";
                    };
                    ?>

    <!-- Comment -->
    <div class='comment_space_container'>

        <!-- Write a comment -->
        <form>
            <div class='write_comment'>
                <img src='public/sources/img/profile_photo/jstm.jpg' class='pp_profile' alt=''>
                <textarea name='comment' class='comment_textarea' placeholder='Écrire un commentaire...'></textarea>
                <input type='submit' class='send_comment' value=''>
            </div>
        </form>

        <!-- All the comments -->
        <?php

                         $requete="SELECT comment, re_comments.date AS date, username,photo FROM re_comments, re_users, re_films WHERE comments_ext_users=id_users AND comments_ext_films=id_films ORDER BY date DESC";
                        $stmt=$db->query($requete);
                        $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                        foreach($resultat as $comments){
                        
                        echo "
                            <div class='comment_content'>
                                <div class='fb_jsb'>
                                    <div class='fb'>
                                        <img src='{$comments["photo"]}' class='pp_profile' alt=''>
                                        <div class='fb_c_jsb pseudo_date_comment'>
                                            <p class='pseudo'>{$comments["username"]}</p>
                                            <p class='comment_date'>{$comments["date"]}</p>
                                        </div>
                                    </div>
                                    <div class='comment_param_container'>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                    
                                <p class='comment_text'>{$comments["comment"]}</p>
                    
                                <div class='fb_jsa'>
                                    <div class='fb_jsb'>
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn_icon.svg' alt=''>
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <div class='fb_jsb comment_container'>
                                        <img class='comment_icon' src='public/sources/img/comment_icon.svg' alt=''>
                                        <p class='comment_number'>8 réponses</p>
                                    </div>
                                    <div class='fb_jsb share_container'>
                                        <img class='share_icon' src='public/sources/img/share_icon.svg' alt=''>
                                        <p class='share_title'>Partager</p>
                                    </div>
                                </div>
                            </div>";

                            
                        }
                        
                        ?>
    </div>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/register.js"></script>
    <script src="public/assets/js/register_film.js"></script>
</body>

</html>