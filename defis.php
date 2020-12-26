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
    <link rel="stylesheet" href="public/assets/css/defis.css">
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
                <p class="category_title" number="2" number1="1" number2="3">Défis populaires</p>
                <p class="category_title" number="3" number1="1" number2="2">Défis à découvrir</p>
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
                <a href="fil_actu.php"> <img src="public/sources/img/fil_actu_icon.svg" class="defi_icon" alt=""></a>
                <!-- Profile photo -->
                <img src="public/sources/img/pdp.jpg" class="menu_pp" alt="">
            </div>
        </nav>

        <!-- Category list  -->
        <div class="category_list_container">
            <p class="category_list_category" number="1" number1="2" number2="3">Défis du moment</p>
            <p class="category_list_category" number="2" number1="1" number2="3">Défis populaires</p>
            <p class="category_list_category" number="3" number1="1" number2="2">Défis à découvrir</p>
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

        <!-- "Ajout récent" catégory -->
        <div class="first_category">

            <!-- Category title -->
            <h1>DÉFIS DU MOMENT</h1>

            <!-- Challenges container -->
            <div class="defi_container ">

                <!-- Challenge n°1-->
                <a href="defi1.php" class="defi_content" defi="1">
                    <img class="defi_img defi1_img" src="public/sources/img/defi1.jpg" alt="">
                    <p class="defi_title defi1_title">SAINT-VALENTIN</p>
                    <p class="defi_time">Temps restant : 14h 30min</p>
                </a>

                <!-- Challenge n°2-->
                <a href="defi2.php" class="defi_content" defi="2">
                    <img class="defi_img defi2_img" src="public/sources/img/avion.jpg" alt="">
                    <p class="defi_title defi2_title">AVION</p>
                    <p class="defi_time">Temps restant : 2 semaines et 3 jours</p>
                </a>
            </div>
        </div>

        <!-- "Défis populaires" catégory -->
        <div class="second_category">

            <!-- prev arrow -->
            <div class="arrow_prev_container fp-controlArrow fp-prev">
                <!-- Arrow -->
                <img src="public/sources/img/prev_arrow.svg" class="prev_arrow" alt="">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1 class="title2">DÉFIS POPULAIRES</h1>

                <!-- Challenges container -->
                <div class="defi_pop_container ">

                    <!-- Challenge n°1-->
                    <a href="defi1.php" class="defi_pop_content" defi="1">
                        <img class="defi_img defi_pop_img" src="public/sources/img/defi1.jpg" alt="">
                        <p class="defi_pop_title">SAINT-VALENTIN</p>
                    </a>

                    <!-- Challenge n°2-->
                    <a href="defi2.php" class="defi_pop_content" defi="2">
                        <img class="defi_img defi_pop_img" src="public/sources/img/avion.jpg" alt="">
                        <p class="defi_pop_title">AVION</p>
                    </a>

                    <!-- Challenge n°1-->
                    <a href="defi1.php" class="defi_pop_content" defi="1">
                        <img class="defi_img defi_pop_img" src="public/sources/img/defi1.jpg" alt="">
                        <p class="defi_pop_title">SAINT-VALENTIN</p>
                    </a>

                    <!-- Challenge n°2-->
                    <a href="defi2.php" class="defi_pop_content" defi="2">
                        <img class="defi_img defi_pop_img" src="public/sources/img/avion.jpg" alt="">
                        <p class="defi_pop_title">AVION</p>
                    </a>

                </div>
            </div>

            <!-- next arrow -->
            <div class="arrow_next_container fp-controlArrow fp-next">
                <!-- Arrow -->
                <img src="public/sources/img/next_arrow.svg" class="next_arrow" alt="">
            </div>
        </div>

        <div class="third_category">

            <!-- prev arrow -->
            <div class="arrow_prev_container fp-controlArrow fp-prev">
                <!-- Arrow -->
                <img src="public/sources/img/prev_arrow.svg" class="prev_arrow" alt="">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1>À DÉCOUVRIR</h1>

                <div class="defi_pop_container ">

                    <!-- Challenge n°1-->
                    <a href="defi1.php" class="defi_pop_content" defi="1">
                        <img class="defi_img defi_pop_img" src="public/sources/img/defi1.jpg" alt="">
                        <p class="defi_pop_title">SAINT-VALENTIN</p>
                    </a>

                    <!-- Challenge n°2-->
                    <a href="defi2.php" class="defi_pop_content" defi="2">
                        <img class="defi_img defi_pop_img" src="public/sources/img/avion.jpg" alt="">
                        <p class="defi_pop_title">AVION</p>
                    </a>

                    <!-- Challenge n°1-->
                    <a href="defi1.php" class="defi_pop_content" defi="1">
                        <img class="defi_img defi_pop_img" src="public/sources/img/defi1.jpg" alt="">
                        <p class="defi_pop_title">SAINT-VALENTIN</p>
                    </a>

                    <!-- Challenge n°2-->
                    <a href="defi2.php" class="defi_pop_content" defi="2">
                        <img class="defi_img defi_pop_img" src="public/sources/img/avion.jpg" alt="">
                        <p class="defi_pop_title">AVION</p>
                    </a>

                </div>
            </div>

            <!-- next arrow -->
            <div class="arrow_next_container fp-controlArrow fp-next">
                <!-- Arrow -->
                <img src="public/sources/img/next_arrow.svg" class="next_arrow" alt="">
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/register.js"></script>
</body>

</html>