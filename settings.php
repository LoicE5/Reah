<?php
    include('assets/php/config.php');


// Modifier son profil
if(isset($_POST["modify_btn"])){

    $id = $_COOKIE['userid'];
    $username = addslashes($_POST['username']);
    // $profile_picture = $_POST['profile_picture'];
    // $banner = $_POST['banner'];
    $name = addslashes($_POST['name']);
    $website = $_POST['website'];
    $bio = addslashes($_POST['bio']);

    $content_dir_picture = 'database/profile_pictures/';
    $tmp_file_picture = $_FILES['profile_picture']['tmp_name'];
    $name_file_picture = basename($_FILES['profile_picture']['name']);

    $content_dir_banner = 'database/banners/';
    $tmp_file_banner = $_FILES['banner']['tmp_name'];
    $name_file_banner = basename($_FILES['banner']['name']);

    if ($_FILES["profile_picture"]['error'] == 0 && $_FILES["banner"]['error'] == 0 ) {

        if(!is_uploaded_file($tmp_file_picture) || !is_uploaded_file($tmp_file_banner)) {
            $message_false = "Le fichier est introuvable.";
        }
    
        if(!move_uploaded_file($tmp_file_picture, $content_dir_picture . $name_file_picture) || !move_uploaded_file($tmp_file_banner, $content_dir_banner . $name_file_banner)){
            $message_false = "Impossible de copier le fichier dans notre dossier.";
        }

        $sql = "UPDATE users SET user_profile_picture='$name_file_picture', user_banner='$name_file_banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";

    } else if ($_FILES["profile_picture"]['error'] == 0 ) {
    

        if(!is_uploaded_file($tmp_file_picture)) {
            $message_false = "Le fichier est introuvable.";
        }
    
        if(!move_uploaded_file($tmp_file_picture, $content_dir_picture . $name_file_picture)){
            $message_false = "Impossible de copier le fichier dans notre dossier.";
        }

        $sql = "UPDATE users SET user_profile_picture='$name_file_picture', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";

    } else if ($_FILES["banner"]['error'] == 0 ) {

        if(!is_uploaded_file($tmp_file_banner)) {
            $message_false = "Le fichier est introuvable.";
        }
    
        if(!move_uploaded_file($tmp_file_banner, $content_dir_banner . $name_file_banner)){
            $message_false = "Impossible de copier le fichier dans notre dossier.";
        }

        $sql = "UPDATE users SET user_banner='$name_file_banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    } else {
        $sql = "UPDATE users SET user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    }

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $message_true = 'Ton profil a bien été modifié !';

}

// Vérifier le format du mdp
function check_mdp_format($mdp)
{
	$majuscule = preg_match('@[A-Z]@', $mdp);
	$minuscule = preg_match('@[a-z]@', $mdp);
	
	if(!$majuscule || !$minuscule || strlen($mdp) < 8)
	{
		return false;
	}
	else 
		return true;
}

// Changer son mdp
if(isset($_GET["change_mdp_btn"])){

    $user_id = $_COOKIE['userid'];
    $query = "SELECT * FROM users WHERE user_id = '$user_id';";

    $stmt = $db->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(password_verify($_GET["prev_mdp"], $row['user_password'])){
        if($_GET['new_mdp'] == $_GET['confirm_mdp']){

            // $sql = "UPDATE users (:user_lastname, :user_firstname, :user_username, :user_email, :user_password, :user_status, :user_CGU, :user_profile_picture, :user_banner, :user_name, :user_website, :user_bio) VALUES (NULL, NULL,NULL,NULL,:psw,NULL,NULL,NULL,NULL,NULL,NULL,NULL) WHERE user_id='11'";
            // if(checkPassword($_GET['new_mdp'])){

                if (check_mdp_format($_GET['new_mdp']) == true){
    
                $password = password_hash($_GET['new_mdp'], PASSWORD_DEFAULT);
                $sql = "UPDATE users SET user_password='$password' WHERE user_id='$user_id'";
            
                // $attributes = array(
                //   'psw' => password_hash($_GET['new_mdp'], PASSWORD_DEFAULT),
                // );
              
            
                $stmt = $db->prepare($sql);
            
                $stmt->execute($attributes);
            
                $db = null;
            
                header("Location: settings.php?success=true");
            
            } else{
                $message_false = 'Votre mot de passe doit contenir au moins 8 caractères dont 1 majuscule et 1 minuscule';
            }
        } else {
            $message_false = 'Verifiez que les deux mots de passe correspondent.';
        }
    } else{
        $message_false = 'L\'ancien mot de passe choisi est incorrecte.';

    }

}

// Supression d'un utilisateur
if (isset($_GET['delete_account'])) {

    $user_id = $_GET['delete_account'];
    
    $sql = "DELETE FROM users WHERE user_id='$user_id'; DELETE FROM videos WHERE video_user_id='$user_id'; DELETE FROM distribution WHERE distribution_user_id = '$user_id'; DELETE FROM comments WHERE comment_user_id = '$user_id'; DELETE FROM saved WHERE saved_user_id = '$user_id'; DELETE FROM liked WHERE liked_user_id = '$user_id'; DELETE FROM subscription WHERE subscription_subscriber_id = '$user_id'; DELETE FROM subscription WHERE subscription_artist_id = '$user_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    
    header('Location: ressources/logout.php?delete_account=true');

}


// // Suspension d'un utilisateur
// if (isset($_GET['user_suspend'])) {

//     $user_id = $_GET['user_suspend'];

//     $query = "SELECT * FROM users WHERE user_id = '$user_id';";
//     $stmt = $db->prepare($query);
//     $stmt->execute();
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
//     $query = "UPDATE users SET user_suspended='1' WHERE user_id = '$user_id';";
//     $stmt = $db->prepare($query);
//     $stmt->execute();
    
    
//     $message_true='L\'utilisateur '.$row['user_username'].' a bien été suspendu.';
// }

// // Désuspension d'un utilisateur
// if (isset($_GET['user_suspend_true'])) {

//     $user_id = $_GET['user_suspend_true'];

//     $query = "SELECT * FROM users WHERE user_id = '$user_id';";
//     $stmt = $db->prepare($query);
//     $stmt->execute();
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
//     $query = "UPDATE users SET user_suspended='0' WHERE user_id = '$user_id';";
//     $stmt = $db->prepare($query);
//     $stmt->execute();
    
    
//     $message_true='L\'utilisateur '.$row['user_username'].' a bien été désuspendu.';
// }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Paramètres</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/profil.css">
    <link rel="stylesheet" href="assets/css/settings.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
</head>

<body>


    <?php

    if (isset($message_true)) {
        echo '<p class="message_true_container">'.$message_true.'</p>';
    }

    if (isset($message_false)) {
        echo '<p class="message_false_container">'.$message_false.'</p>';
    }

    if (isset($_GET['success'])) {
        echo'<p class="message_true_container">Ton mot de passe a bien été modifié !</p>';
    }
  
    ?>

    <main class="main_content">

        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> </a>

            <!-- Search bar -->
            <form action="search.php" method="GET" class="form_search_bar">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs..."
                    oninput="searchEngine(this.value)">
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
                    <?php
                        echo"<div style='background: url(database/banners/".$row['user_banner'].") no-repeat center/100%' alt=''  class='modify_banner'></div>";
                    ?>
                    <form action="settings.php" method="post" enctype='multipart/form-data'>

                        <div class="modify_profile_photo_container">
                            <!-- Profile photo -->
                            <?php
                            echo"<img src='database/profile_pictures/".$row['user_profile_picture'] ."' alt=''  class='modify_profile_photo'>";
                        ?>

                            <div class="modify_file_container">
                                <!-- Input banner -->
                                <div class="modify_file_banner btn">
                                    <button class="btn modify_btn_banner">Modifier la bannière</button>
                                    <input type="file" name="banner" accept=".png,.jpeg,.jpg" class="">
                                </div>
                                <!-- Input profile photo -->
                                <div class="modify_file_profile_photo btn">
                                    <button class="btn modify_btn_profile_photo">Modifier la photo de profil</button>
                                    <input type="file" name="profile_picture" accept=".png,.jpeg,.jpg" class="">
                                </div>

                            </div>
                        </div>
                        <!-- Inputs username, name, bio.. -->
                        <div class="modify_input_container">
                            <div class="all_input_container">
                                <div class="input_container">
                                    <label for="name">
                                        <span>Nom</span>
                                        <input type="text" class="input_connexion" id="name" name="name"
                                            value="<?php echo $row['user_name'];?>">
                                    </label>
                                </div>
                                <div class="input_container">
                                    <label for="website">
                                        <span>Site web</span>
                                        <input type="text" class="input_connexion" id="website" name="website"
                                            value="<?php echo $row['user_website'];?>">
                                    </label>
                                </div>
                                <div class="input_container">
                                    <label for="bio">
                                        <span>Bio</span>
                                        <textarea class="input_connexion input_bio" id="bio" name="bio" cols="30"
                                            rows="10"><?php echo $row['user_bio'];?></textarea>
                                    </label>
                                </div>
                            </div>

                            <input type="submit" class="btn modify_btn" name="modify_btn" value="Modifier">
                        </div>
                    </form>

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
                    <form action="settings.php" method="GET">
                        <div class="change_mdp_container">
                            <h2 class="settings_title">
                                <div class="red_line settings_title_line"></div>Changer de mot de passe
                            </h2>

                            <div class="all_input_container">

                                <div class="input_container">
                                    <label for="prev_mdp">
                                        <span>Ancien mot de passe</span>
                                        <input type="password" class="input_connexion" id="prev_mdp" name="prev_mdp"
                                            required>
                                    </label>
                                </div>


                                <div class="input_container">
                                    <label for="new_mdp">
                                        <span>Nouveau mot de passe</span>
                                        <input type="password" class="input_connexion" id="new_mdp" name="new_mdp"
                                            required>
                                    </label>
                                    <p class="mdp_restriction">*8 caractères / 1 majuscule / 1 minuscule</p>
                                </div>


                                <div class="input_container">
                                    <label for="confirm_mdp">
                                        <span>Confirmer le nouveau mot de passe</span>
                                        <input type="password" class="input_connexion" id="confirm_mdp"
                                            name="confirm_mdp" required>
                                    </label>
                                </div>

                            </div>
                            <input type="submit" class="btn change_mdp_btn" name="change_mdp_btn"
                                value="Changer de mot de passe">
                        </div>

                    </form>

                    <div>
                        <h2 class="settings_title">
                            <div class="red_line settings_title_line"></div>Suspendre / désactiver mon compte
                        </h2>
                        <p class="delete_link" onclick='popupSuspendAccount()'>Suspendre temporairement mon compte reah
                        </p>
                        <p>Les autres utilisateurs ne pourront plus voir vos œuvres ni voir votre profil mais vous
                            pourrez récupérer votre compte à tout moment. </p>
                    </div>

                    <div>
                        <p class="delete_link" onclick='popupDeleteAccount()'>Supprimer mon compte reah</p>
                        <p>Les autres utilisateurs pourront plus voir vos œuvres ni voir votre profil. Vous ne pourrez
                            pas
                            récupérer votre compte. <br>
                            <span> ATTENTION</span> cette action est irréversible !</p>
                    </div>

                    <div>
                        <p></p>
                    </div>
                </div>


                <!-- Security -->
                <div class="settings_container settings_security_container" number="3">
                    <h2 class="settings_title">
                        <div class="red_line settings_title_line"></div>Confidentialité du compte
                    </h2>

                    <p>REAH étant une plateforme de concours, nous sommes dans l'obligation de rendre votre compte
                        public afin que tous les utilisateurs puissent voir vos courts-métrages et voter. <br> Avoir un
                        compte privé serait contradictoire avec le but de la plateforme : exposer ses réalisations et
                        gagner en visibilité</p>

                    <h2 class="settings_title">
                        <div class="red_line settings_title_line"></div>Statut en ligne
                    </h2>

                    <p>Aucun utilisateur ne peut voir votre acitivité en ligne.</p>

                    <h2 class="settings_title">
                        <div class="red_line settings_title_line"></div>Protection des données
                    </h2>

                    <p>Les informations recueillies sur le formulaire d’inscription sont enregistrées dans notre base de
                        données
                        informatisée par nos développeurs pour créer votre profil Reah.</p>

                    <p>Les données collectées seront communiquées aux seuls destinataires suivants : Étienne Loïc, Saint
                        Martin
                        Julie, Bassimane Manar, Baillon Edouard et Lad Minal.</p>
                    <p>Les données sont conservées jusqu’à la suppression souhaitée par l’utilisateur. En cas
                        d’inactivité
                        pendant 2
                        ans entraînera la suppression du compte et des données.</p>
                    <p>Vous pouvez accéder aux données vous concernant, les rectifier, demander leur effacement ou
                        exercer votre
                        droit à la limitation du traitement de vos données. Vous pouvez retirer à tout moment votre
                        consentement
                        au
                        traitement de vos données ; Vous pouvez également vous opposer au traitement de vos données ;
                        Vous
                        pouvez
                        également exercer votre droit à la portabilité de vos données.</p>
                    <p>Consultez le site <a target="_blank" href="https://www.cnil.fr">cnil.fr </a> pour plus
                        d’informations sur vos droits.</p>
                    <p>Pour exercer ces droits ou pour toute question sur le traitement de vos données dans ce
                        dispositif, vous
                        pouvez contacter <a target="_blank" href="mailto:reahapp.fr@gmail.com"
                            class="not_a_link">reahapp.fr@gmail.com</a>.</p>

                    <p>Si vous estimez, après nous avoir contactés, que vos droits « Informatique et Libertés » ne sont
                        pas
                        respectés, vous pouvez adresser une réclamation à la CNIL.</p>
                </div>

            </div>



    </main>

    <!-- Delete account warning -->

    <div class='delete_dark_filter' onclick='closePopupSuspendAccount()'></div>


    <div class='pop_up_container suspend_account_container'>
        <div class='pop_up_header'>
            <h2>Suspendre son compte</h2>
            <img src='sources/img/close_icon.svg' class='delete_close_icon' alt='' onclick='closePopupSupendAccount()'>
        </div>
        <p class='pop_up_text'>Es-tu sûr de vouloir suspendre ton compte ?</p>
        <div class='btn pop_up_btn delete_btn'>Suspendre</div>
    </div>


    <!-- Delete account warning -->

    <div class='delete_dark_filter' onclick='closePopupDeleteAccount();closePopupSuspendAccount()'></div>


    <div class='pop_up_container delete_account_container'>
        <div class='pop_up_header'>
            <h2>Supprimer son compte</h2>
            <img src='sources/img/close_icon.svg' class='delete_close_icon' alt='' onclick='closePopupDeleteAccount()'>
        </div>
        <p class='pop_up_text'>Es-tu sûr de vouloir supprimer ton compte ?</p>
        <a href='settings.php?delete_account=<?php echo $_COOKIE['userid']?>'
            class='btn pop_up_btn delete_btn'>Supprimer</a>
    </div>



    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>