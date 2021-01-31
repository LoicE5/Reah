<?php
    require("header.php");
    require("pop_up_film_information.php");
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Profil</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/fil_actu.css">
    <link rel="stylesheet" href="public/assets/css/profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/assets/css/fullpage.css" />

</head>

<body>
    <main class="main_content">

        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> <img src="public/sources/img/logo_reah.svg" alt=""></a>

            <!-- Search bar -->
            <form action="" class="form_search_bar">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
            </form>

            <div class="menu_profile">
                <!-- Home icon -->
                <a href="fil_actu.php"> <img src="public/sources/img/fil_actu_icon.svg" class="defi_icon" alt=""></a>
                <!-- Challenge icon -->
                <a href="defis.php"> <img src="public/sources/img/defi_icon.svg" class="defi_icon" alt=""></a>
                <!-- Profile photo -->
                <img src="public/sources/img/profil_icon.svg" class="defi_icon menu_pp" alt="">
            </div>
        </nav>

        <!-- Menu -->
        <?php
        require("menu.php");
        ?>


        <div class="banner_container">
            <div class="banner_flou_left"></div>
            <div class="banner"></div>
            <div class="banner_flou_right"></div>
        </div>

        <div class="profile_container">

            <div class="fb_jsa profile_content1">
                <!-- Subscription section -->
                <div class="fb_c ai-c">
                    <div class="fb_jsb profile_subscription_container">
                        <div class="profile_subscription_content" number="1">
                            <p class="fb profile_subscription_number">1213</p>
                            <div class="red_line profile_subscription_line"></div>
                            <p class="profile_subscription_title">Abonnés</p>
                        </div>

                        <div class="profile_subscription_content" number="2">
                            <p class="fb profile_subscription_number">2000</p>
                            <div class="red_line profile_subscription_line"></div>
                            <p class="profile_subscription_title">Abonnements</p>
                        </div>
                    </div>

                    <div class="btn subscribe_btn">S'abonner</div>
                </div>
                <!-- Profile photo + username -->
                <img src="database/profile_picture/minmin.jpg" alt="" class="profile_photo">
            </div>

            <div class="fb_jsb profile_content2">
                <div class="fb profile_bio_container">
                    <p class="profile_username">MinminDddddddddddddddd</p>
                    <div class="red_line profile_line"></div>
                    <p class="profile_name">Minal Lad</p>
                    <p class="profile_bio">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem
                        <br>
                        laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d <br><br><br> olor,
                        voluptatem recusandae
                        <br>
                        assumenda rerum facereeee</p>

                </div>
                <div class="fb_c">
                    <img src="public/sources/img/modify_icon.svg" class="modify_icon" alt="">
                </div>
            </div>
        </div>

        <!-- Realisations's number -->

        <div class="fb_jc realisation_number_container">
            <div class="fb_jsb realisation_number_content">
                <p class="realisation_number_content_title realisation_number_content_title1" number="2"><span
                        class="realisation_number_content_number ">20</span> réalisations </p>
                <p class="realisation_number_content_title realisation_number_content_title2" number="1"><span
                        class="realisation_number_content_number">80</span> identifiés </p>
                <div class="red_line realisation_number_content_line"></div>
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
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
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
                            <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
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

    <!-- Modify btn -->
    <div class="modify_container">
        <form action="oui.php" method="get">
            <!-- Close icon -->
            <img src='public/sources/img/close_icon.svg' class='modify_close_icon' alt=''>

            <!-- Banner -->
            <div class="modify_banner"></div>

            <div class="modify_profile_photo_container">
                <!-- Profile photo -->
                <img src="database/profile_picture/minmin.jpg" alt="" class="modify_profile_photo">

                <div class="modify_file_container">
                    <!-- Input banner -->
                    <div class="modify_file_banner">
                        <button class="btn modify_btn_banner">Modifier la bannière</button>
                        <input type="file" class="">
                    </div>
                    <!-- Input profile photo -->
                    <div class="modify_file_profile_photo">
                        <button class="btn modify_btn_profile_photo">Modifier la photo de profil</button>
                        <input type="file" class="">
                    </div>

                </div>
            </div>
            <!-- Inputs username, name, bio.. -->
            <div class="modify_input_container">
                <div class="input_container">
                    <label for="username">
                        <span>Nom d'utilisateur</span>
                        <input type="text" class="input_connexion" id="username" name="username">
                    </label>
                </div>
                <div class="input_container">
                    <label for="name">
                        <span>Nom</span>
                        <input type="text" class="input_connexion" id="name" name="name">
                    </label>
                </div>
                <div class="input_container">
                    <label for="website">
                        <span>Site web</span>
                        <input type="text" class="input_connexion" id="website" name="website">
                    </label>
                </div>
                <div class="input_container">
                    <label for="bio">
                        <span>Bio</span>
                        <textarea class="input_connexion input_bio" id="bio" name="bio" cols="30" rows="10"></textarea>
                    </label>
                </div>

                <input type="submit" class="btn modify_btn" value="Modifier">
            </div>
        </form>
    </div>

    <!-- Subscribers and subsciptions page -->
    <div class="pop_up_container subscription_container">
        <div class="pop_up_header subscription_header">
            <!-- Username -->
            <h2>MinminDddddddddddddddd</h2>
            <!-- Close icon -->
            <img src='public/sources/img/close_icon.svg' class='close_icon' alt=''>
        </div>

        <!-- Title -->
        <div class="subsciption_title_container">
            <div class="subscription_title1 subscriber_title" number="2"><span
                    class="realisation_number_content_number ">1213 </span> Abonnés</div>
            <div class="subscription_title2 subscription_title" number="1"><span
                    class="realisation_number_content_number ">2000 </span> Abonnements</div>
            <div class="red_line subscription_line"></div>
        </div>

        <div class="pop_up_text subscription_content">
            <!-- All subscribers -->
            <div class="subscriber_section">

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscriber_user_btn">Supprimer</div>
                </div>

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscriber_user_btn">Supprimer</div>
                </div>

            </div>

            <!-- All subscriptions -->
            <div class="subscription_section">

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscription_user_btn subcribe_btn_click">Abonné(e)</div>
                </div>

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscription_user_btn subcribe_btn_click">Abonné(e)</div>
                </div>
            </div>
        </div>

    </div>

    <div class="unfollow_dark_filter"></div>

    <!-- Unfollow pop up-->
    <div class="pop_up_container unfollow_container">
        <div class="pop_up_header">
            <h2>Se désabonner</h2>
            <img src='public/sources/img/close_icon.svg' class='unfollow_close_icon' alt=''>
        </div>
        <p class="pop_up_text">Se désabonner de MinminDddddddddddddddd ?</p>
        <div class="btn pop_up_btn unfollow_btn">Se désabonner</div>
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/register.js"></script>
    <script src="public/assets/js/profil.js"></script>
    <script src="public/assets/js/fil_actu.js"></script>
</body>

</html>