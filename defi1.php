<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Fil d'actu</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/fil_actu.css">
    <link rel="stylesheet" href="public/assets/css/defis.css">
    <link rel="stylesheet" href="public/assets/css/defi1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/assets/css/fullpage.css" />

</head>

<body>
    <main class="main_content">


        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> <img src="public/img/logo_reah.svg" alt=""></a>

            <!-- Categories's title -->
            <div class="menu_category">
                <p class="category_title category_title1" number="1" number1="2" number2="3">Défi</p>
                <p class="category_title category_title2" number="2" number1="1" number2="3">Courts-métrages</p>
                <p class="category_title category_title3" number="3" number1="1" number2="2">Classement</p>
                <div class="underline"></div>
                <div class="fb_jsb ai-c category_list">
                    <p class="category_list_title">Catégories</p>
                    <div class="category_triangle"></div>
                </div>
            </div>

             <!-- Search bar -->
             <form action="">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
            </form>

            <div class="menu_profile">
                <!-- Home icon -->
                <a href="fil_actu.php"> <img src="public/img/fil_actu_icon.svg" class="defi_icon" alt=""></a>
                <!-- Profile photo -->
                <!-- Defi icon -->
                <a href="defis.php"> <img src="public/img/defi_icon.svg" class="defi_icon" alt=""></a>
                <img src="public/img/pdp.jpg" class="menu_pp" alt="">
            </div>
        </nav>

        <!-- Category list  -->
        <div class="category_list_container">
        
            <p class="category_list_category" number="1" number1="2" number2="3">Défi</p>
                        <p class="category_list_category" number="2" number1="1" number2="3">Couts-métrages</p>
                        <p class="category_list_category" number="3" number1="1" number2="2">Classement</p>
                </div>

         <!-- Menu -->
         <div class="menu_container">
            <a href="connexion.php" class="menu_option sign_in">Se connecter</a>
            <a href="public/index.php" class="menu_option sign_up">S'inscrire</a>

            <!-- Profile -->
            <a href="profil.php" class="menu_option profil">
                <img src="public/img/profile_icon.svg" alt="">
                <p class="menu_option_title">Profil</p>
            </a>

            <!-- Notifications -->
            <a href="" class="menu_option notifications">
                <img src="public/img/notifications_icon.svg" alt="">
                <p class="menu_option_title">Notifications</p>
            </a>

            <a href="" class="registered menu_option">
                 <img src="public/img/saved_icon.svg" alt="">
                <p class="menu_option_title">Enregistrés</p>
            </a>
            <a href="" class="settings menu_option">
                <img src="public/img/settings_icon.svg" alt="">
                <p class="menu_option_title">Paramètres</p>
            </a>
            <a href="" class="disconnection menu_option">
                <img src="public/img/disconnection_icon.svg" alt="">
                <p class="menu_option_title">Déconnexion</p>
            </a>
        </div>

        <!-- "Ajout récent" catégory -->
        <div class="first_category">

            <!-- Category title -->
            <h1>SAINT-VALENTIN</h1>

            <!-- Challenges container -->
            <div class="defi_container ">

                <p>Défi : <br> Faire un court-métrage sur le thème de la Saint-Valentin.</p>

                <div class="defi_information">
                    <p>Temps restant : 14 heures et 30 minutes</p>
                    <p>Nombre de courts-métrages déposés : 27</p>
                </div>
            </div>
        </div>

        <div class="second_category">

            <!-- prev arrow -->
            <div class="arrow_prev_container">
                <!-- Arrow -->
                <img src="public/img/prev_arrow.svg" class="prev_arrow" alt="">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1 class="title2">COURTS-MÉTRAGES</h1>

                <!-- All videos -->
                <div class="all_video_container">

                    <!-- Video container -->
                    <div class="video_container ">

                        <!-- Short film -->
                        <div class="video_content">
                            <video class="video_content" poster="" muted>
                                <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
                            </video>
                            <!-- Name + pp -->
                            <div class="profile_container">
                                <img src="public/img/pdp.jpg" class="pp_profile" alt="">
                                <p class="pseudo">Lecréateur123</p>
                            </div>

                            <!-- Time -->
                            <p class="time">4min 40</p>
                        </div>

                        <!-- Short film's informations -->
                        <div class="description_container">
                            <div class="flex_box">
                                <div class="synopsis_title_container">
                                    <h3 class="synopsis_title">Dernière rencokkkk dqzd dqzd </h3>
                                    <p class="see_more">Voir plus
                                        <img src="public/img/see_more_arrow.svg" class="see_more_arrow" alt="">
                                </div>
                                </p>
                                <div class="reaction_container">
                                    <div class="flex_box">
                                        <!-- Like's number -->
                                        <p class="pop_corn_number">515</p>
                                        <!-- Pop corn image -->
                                        <img class="pop_corn_logo" src="public/img/pop_corn.png" alt="">
                                    </div>
                                    <!-- Comment icon -->
                                    <img src="public/img/comment_icon.svg" class="reaction_icons" alt="">

                                    <!-- Share icon -->
                                    <img src="public/img/share_icon.svg" class="reaction_icons" alt="">

                                </div>
                            </div>
                            <p>Un homme se fait poursuivre dans les rues de Paris, il essaye d'échapper à ses démons
                                bien motivés à ne pas le lâcher. Un homme se fait poursuivre dans les rues de Paris, il
                                essaye d'échapper à ses démons
                                bien motivés à ne pas le lâcher.</p>
                        </div>
                    </div>

                    <!-- Video container -->
                    <div class="video_container ">

                        <!-- Short film -->
                        <div class="video_content">
                            <video class="video_content" poster="" muted>
                                <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
                            </video>
                            <!-- Name + pp -->
                            <div class="profile_container">
                                <img src="public/img/pdp.jpg" class="pp_profile" alt="">
                                <p class="pseudo">Lecréateur123</p>
                            </div>

                            <!-- Time -->
                            <p class="time">4min 40</p>
                        </div>

                        <!-- Short film's informations -->
                        <div class="description_container">
                            <div class="flex_box">
                                <div class="synopsis_title_container">
                                    <h3 class="synopsis_title">Dernière rencokkkk dqzd dqzd </h3>
                                    <p class="see_more">Voir plus
                                        <img src="public/img/see_more_arrow.svg" class="see_more_arrow" alt="">
                                </div>
                                </p>
                                <div class="reaction_container">
                                    <div class="flex_box">
                                        <!-- Like's number -->
                                        <p class="pop_corn_number">515</p>
                                        <!-- Pop corn image -->
                                        <img class="pop_corn_logo" src="public/img/pop_corn.png" alt="">
                                    </div>
                                    <!-- Comment icon -->
                                    <img src="public/img/comment_icon.svg" class="reaction_icons" alt="">

                                    <!-- Share icon -->
                                    <img src="public/img/share_icon.svg" class="reaction_icons" alt="">

                                </div>
                            </div>
                            <p>Un homme se fait poursuivre dans les rues de Paris, il essaye d'échapper à ses démons
                                bien motivés à ne pas le lâcher. Un homme se fait poursuivre dans les rues de Paris,
                                il
                                essaye d'échapper à ses démons
                                bien motivés à ne pas le lâcher.</p>
                        </div>
                    </div>


                    <!-- Video container -->
                    <div class="video_container ">

                        <!-- Short film -->
                        <div class="video_content">
                            <video class="video_content" poster="" muted>
                                <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
                            </video>
                            <!-- Name + pp -->
                            <div class="profile_container">
                                <img src="public/img/pdp.jpg" class="pp_profile" alt="">
                                <p class="pseudo">Lecréateur123</p>
                            </div>

                            <!-- Time -->
                            <p class="time">4min 40</p>
                        </div>

                        <!-- Short film's informations -->
                        <div class="description_container">
                            <div class="flex_box">
                                <div class="synopsis_title_container">
                                    <h3 class="synopsis_title">Dernière rencokkkk dqzd dqzd </h3>
                                    <p class="see_more">Voir plus
                                        <img src="public/img/see_more_arrow.svg" class="see_more_arrow" alt="">
                                </div>
                                </p>
                                <div class="reaction_container">
                                    <div class="flex_box">
                                        <!-- Like's number -->
                                        <p class="pop_corn_number">515</p>
                                        <!-- Pop corn image -->
                                        <img class="pop_corn_logo" src="public/img/pop_corn.png" alt="">
                                    </div>
                                    <!-- Comment icon -->
                                    <img src="public/img/comment_icon.svg" class="reaction_icons" alt="">

                                    <!-- Share icon -->
                                    <img src="public/img/share_icon.svg" class="reaction_icons" alt="">

                                </div>
                            </div>
                            <p>Un homme se fait poursuivre dans les rues de Paris, il essaye d'échapper à ses démons
                                bien motivés à ne pas le lâcher. Un homme se fait poursuivre dans les rues de Paris, il
                                essaye d'échapper à ses démons
                                bien motivés à ne pas le lâcher.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- next arrow -->
            <div class="arrow_next_container fp-controlArrow fp-next">
                <!-- Arrow -->
                <img src="public/img/next_arrow.svg" class="next_arrow" alt="">
            </div>
        </div>

        <div class="third_category">

            <!-- Category content  -->
            <div class="classement_content">

                <!-- Category title -->
                <h1>CLASSEMENT</h1>

                <div class="classement_container">

                    <div class="classement_video video1">
                        <video class="video" poster="" muted>
                            <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
                        </video>
                        <!-- Name + pp -->
                        <div class="profile_container">
                            <img src="public/img/pdp.jpg" class="pp_profile" alt="">
                            <p class="pseudo">Lecréateur123</p>
                        </div>

                        <!-- Time -->
                        <p class="time">4min 40</p>
                    </div>

                    <div class="classement_video video2">
                        <video class="video" poster="" muted>
                            <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
                        </video>
                        <!-- Name + pp -->
                        <div class="profile_container">
                            <img src="public/img/pdp.jpg" class="pp_profile" alt="">
                            <p class="pseudo">Lecréateur123</p>
                        </div>

                        <!-- Time -->
                        <p class="time">4min 40</p>
                    </div>

                    <div class="classement_video video3">
                        <video class="video" poster="" muted>
                            <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
                        </video>
                        <!-- Name + pp -->
                        <div class="profile_container">
                            <img src="public/img/pdp.jpg" class="pp_profile" alt="">
                            <p class="pseudo">Lecréateur123</p>
                        </div>

                        <!-- Time -->
                        <p class="time">4min 40</p>
                    </div>


                </div>

                <!-- Podium img -->
                <img src="public/img/podium.svg" class="podium_img" alt="">
            </div>

        </div>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/register.js"></script>
</body>

</html>