<?php
    include('assets/php/config.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Paramètres</title>
    <link rel="stylesheet" href="assets/css/dark_mode.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/profil.css">
    <link rel="stylesheet" href="assets/css/settings.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
</head>

<body>

    <main class="main_content">

        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> </a>

            <!-- Search bar -->
            <form action="" class="form_search_bar">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
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
                    <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover'  class='menu_pp' onclick='toggleBurgerMenu()'></div>
                    </div>
                    </nav>";

                } else {
                    redirect('login.php');
                }
            ?>

            <?php
        require("ressources/menu.php");
        ?>
            <div class="fb">

                <div class="settings_menu">
                    <div class="red_line settings_menu_line"></div>
                    <div class="settings_menu_option settings_menu_option_profile" number="0">Profil</div>
                    <div class="settings_menu_option settings_menu_option_notification" number="1">Notifications</div>
                    <div class="settings_menu_option settings_menu_account" number="2">Compte</div>
                    <div class="settings_menu_option settings_menu_option_security" number="3">Sécurité et
                        confidentialité
                    </div>
                    <div class="menu_btn"></div>
                </div>

                <div class="menu_shadow"></div>

                <!-- Profil -->
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
                        <div class="all_input_container">
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
                                    <textarea class="input_connexion input_bio" id="bio" name="bio" cols="30"
                                        rows="10"></textarea>
                                </label>
                            </div>
                        </div>

                        <input type="submit" class="btn modify_btn" value="Modifier">
                    </div>

                </div>

                <!-- Notifications -->
                <div class="settings_container settings_notification_container" number="1">

                    <!-- Likes -->
                    <div class="like_container">
                        <h2 class="settings_title">
                            <div class="red_line settings_title_line"></div> J'aime
                        </h2>
                        <div>
                            <p>Mentions J'aime <br> <span>Jean-Eude a aimé votre court-métrage.</span> </p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                        <div>
                            <p>Mentions J'aime sur les commentaires<br> <span>Jean-Eude a aimé votre commentaire.</span>
                            </p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                        <div>
                            <p>Mentions J'aime sur les court-métrage où vous êtes identifié<br> <span>Jean-Eude a aimé
                                    un
                                    court-métrage sur lequel vous êtes identifié.</span> </p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="comment_container">
                        <h2 class="settings_title">
                            <div class="red_line settings_title_line"></div>Commentaires
                        </h2>
                        <div>
                            <p>Commentaires <br> <span>Jean-Eude a commenté votre court-métrage.</span> </p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                        <div>
                            <p>Commentaires sur les court-métrage où vous êtes identifié<br> <span>Jean-Eude a commenté
                                    un
                                    court-métrage sur lequel vous êtes identifié.</span> </p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                    </div>

                    <!-- Subscriptions -->
                    <div class="subscribe_container">
                        <h2 class="settings_title">
                            <div class="red_line settings_title_line"></div>Abonnements
                        </h2>
                        <div>
                            <p>Abonnements <br> <span>Jean-Eude a commencé à vous suivre.</span> </p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                    </div>

                    <!-- Challenges -->
                    <div class="defi_container">
                        <h2 class="settings_title">
                            <div class="red_line settings_title_line"></div>Défis
                        </h2>
                        <div>
                            <p>Classement <br> <span>Vous avez gagné le défi "Saint Valentin" !</span> <br> <span>Vous
                                    êtes arrivés deuxième au défi "Saint Valentin" !</span> </p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                        <div>
                            <p>Nouveaux défis <br> <span>Un nouveau défi est disponible !</span></p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                        <div>
                            <p>Temps restant défis <br> <span>Le défi "Saint Valentin" se finit dans 24h !</span></p>
                            <div class="notification_btn">
                                <div></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Account -->
                <div class="settings_container settings_account_container" number="2">
                    <form action="">
                        <div class="change_mdp_container">
                            <h2 class="settings_title">
                                <div class="red_line settings_title_line"></div>Changer de mot de passe
                            </h2>

                            <div class="all_input_container">

                                <div class="input_container">
                                    <label for="prev_mdp">
                                        <span>Ancien mot de passe</span>
                                        <input type="text" class="input_connexion" id="prev_mdp" name="prev_mdp">
                                    </label>
                                </div>


                                <div class="input_container">
                                    <label for="prev_mdp">
                                        <span>Nouveau mot de passe</span>
                                        <input type="text" class="input_connexion" id="prev_mdp" name="prev_mdp">
                                    </label>
                                </div>


                                <div class="input_container">
                                    <label for="prev_mdp">
                                        <span>Confirmer le nouveau mot de passe</span>
                                        <input type="text" class="input_connexion" id="prev_mdp" name="prev_mdp">
                                    </label>
                                </div>

                            </div>
                            <input type="submit" class="btn change_mdp_btn" value="Changer de mot de passe">
                        </div>

                    </form>

                    <div>
                        <h2 class="settings_title">
                            <div class="red_line settings_title_line"></div>Suspendre / désactiver mon compte
                        </h2>
                        <p class="delete_link">Suspendre temporairement mon compte reah</p>
                        <p>Les autres utilisateurs ne pourront plus voir vos œuvres ni voir votre profil mais vous
                            pourrez
                            récupérer votre compte à tout moment. </p>
                    </div>

                    <div>
                        <p class="delete_link">Supprimer mon compte reah</p>
                        <p>Les autres utilisateurs pourront plus voir vos œuvres ni voir votre profil. Vous ne pourrez
                            pas
                            récupérer votre compte. <br>
                            <span> ATTENTION</span> cette action est irréversible !</p>
                    </div>

                    <div>
                        <p></p>
                    </div>
                </div>

            </div>



    </main>



    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>