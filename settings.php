<?php
    require("header.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Paramètres</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/fil_actu.css">
    <link rel="stylesheet" href="public/assets/css/profil.css">
    <link rel="stylesheet" href="public/assets/css/settings.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
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
    
    <?php
        require("menu.php");
        ?>

        <div class="fb">

            <div class="settings_menu">
                <div class="red_line settings_menu_line"></div>
                <div class="settings_menu_option settings_menu_option_profile" number="0">Profil</div>
                <div class="settings_menu_option settings_menu_option_notification" number="1">Notifications</div>
                <div class="settings_menu_option settings_menu_account" number="2">Compte</div>
                <div class="settings_menu_option settings_menu_option_security" number="3">Sécurité et confidentialité</div>
            </div>
    
    
            <div class="settings_container settings_profile_container" number="0">
                <!-- Banner -->
                <div class="modify_banner"></div>
    
                <div class="modify_profile_photo_container">
                    <!-- Profile photo -->
                    <img src="database/profile_picture/minmin.jpg" alt="" class="profile_photo">
    
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
            </div>


            <div class="settings_container settings_notification_container" number="1">
                <div class="like_container">
                    <h2>Mentions J'aime</h2>
                    <div class="like_option">
                        <p>Like <br> <span>Jean-Eude a aimé votre court-métrage</span> </p>
                    </div>
                </div>


            </div>

        </div>



    </main>



    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/settings.js"></script>
    <script src="public/assets/js/fil_actu.js"></script>
</body>

</html>