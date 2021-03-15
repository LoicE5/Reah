<?php include('assets/php/config.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Inscription</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/inscription.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

</head>

<body>

    <a href="fil_actu.php" class="reah_logo">
        <img src="sources/img/dark_reah_logo.png" alt="">
    </a>
    
    <?php
        if( !func::checkLoginState($db) ){
            if( isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['pswd']) && isset($_POST['pswd_confirm']) ) {
        
                $last_name = htmlspecialchars($_POST['last_name']);
                $first_name = htmlspecialchars($_POST['first_name']);
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['pswd']);
                $password_repeat = htmlspecialchars($_POST['pswd_confirm']);

                $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        
        
                if($password != $password_repeat){
                    redirect('signup.php');
                } else {
        
                    $query = "INSERT INTO users (user_lastname,user_firstname,user_username,user_email,user_password,user_status,user_profile_picture) VALUES ('$last_name','$first_name','$username','$email','$hashed_password',0,'profile_pictures/default.jpg')";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    
                    redirect("email_verify.php?client_email=$email");
        
                }
                
            } else {
                makeVisible('main.main_content',true);
            }
        } else {
            redirect('index.php');
        }
    ?>

    <main class="main_content" style="visibility:hidden;">
        <!-- Background video -->
        <video class="background_video" poster="" autoplay loop muted>
            <source src="sources/video/videobackPT.mp4" type="video/mp4">
        </video>


        <!-- Message to fulfil all the conditions necessarys -->
        <div class="alert_message_container">
            <div class="alert_message hide"></div>
        </div>

        <!-- Form part 1-->
        <form id="form1" action="" method="POST">
            <div class="form_container">

                <!-- Google button -->
                <div class="btn google_btn">S'inscrire avec Google</div>

                <!-- "Or" section -->
                <div class="ou_section">
                    <div class="line"></div>
                    <p>OU</p>
                    <div class="line"></div>
                </div>

                <!-- Input last name -->
                <div class="input_container">
                    <label for="last_name">
                        <span>Nom</span>
                        <input type="text" class="input_connexion first_form" name="last_name" id="last_name" required>
                    </label>
                </div>

                <!-- Input first name -->
                <div class="input_container">
                    <label for="first_name">
                        <span>Prénom</span>
                        <input type="text" class="input_connexion first_form" name="first_name" id="first_name"
                            required>
                    </label>
                </div>

                <!-- Select birth day -->
                <div class="select_container">

                    <!-- Day -->
                    <select name="birth_day" class="first_form" required>
                        <option value="" selected="selected" disabled>JJ</option>

                        <?php 
                            
                            for($i = 1; $i < 32; $i++)
                            
                            {
                                
                                echo "<option value=\"$i\">". str_pad($i, 2, '0', STR_PAD_LEFT) ."</option>";
                                
                            }

                            ?>

                    </select>

                    <!-- Month -->
                    <select name="birth_month" class="first_form" required>
                        <option value="" selected="selected" disabled>MM</option>

                        <?php
                            
                            for($i = 1; $i < 13; $i++)
                            
                            {
                                
                                echo "<option value=\"$i\">". str_pad($i, 2, '0', STR_PAD_LEFT) ."</option>";
                                
                            }
                            
                            ?>

                    </select>

                    <!-- Year -->
                    <select name="birth_year" class="first_form" required>
                        <option value="" selected="selected" disabled>AAAA</option>

                        <?php 
                            
                            for($i = date('Y') - 16; $i > 1899; $i--)
                            
                            {
                                
                                echo "<option value=\"$i\">$i</option>";
                                
                            }
                            
                            ?>

                    </select>
                </div>

                <!-- Button next -->
                <div class="btn btn_next cannot_click">Suivant <span class="btn_next_remplissage"></span></div>

                <a href="login.php" class="link">J'ai déjà un compte !</a>
            </div>

            <!-- Form part 2 -->
            <div class="form_container2 fadeOut1">

                <!-- Back arrow -->
                <svg class="btn_prev" xmlns="http://www.w3.org/2000/svg" width="31.621" height="25.241"
                    viewBox="0 0 31.621 25.241">
                    <g class="fleche" id="Groupe_12" data-name="Groupe 12" transform="translate(-754.379 -406.379)">
                        <line class="line" id="Ligne_12" data-name="Ligne 12" x1="0" x2="27"
                            transform="translate(756.5 418.5)" fill="none" stroke="#efe4ef" stroke-linecap="round"
                            stroke-width="3" />
                        <line class="line" id="Ligne_13" data-name="Ligne 13" y1="10" x2="10"
                            transform="translate(756.5 408.5)" fill="none" stroke="#efe4ef" stroke-linecap="round"
                            stroke-width="3" />
                        <line class="line" id="Ligne_14" data-name="Ligne 14" x2="10" y2="10.9"
                            transform="translate(756.5 418.6)" fill="none" stroke="#efe4ef" stroke-linecap="round"
                            stroke-width="3" />
                    </g>
                </svg>

                <!-- Input email -->
                <div class="input_container">
                    <label for="email">
                        <span>E-mail</span>
                        <input type="email" class="input_connexion second_form" name="email" id="email" required>
                    </label>
                </div>

                <!-- Input username -->
                <div class="input_container">
                    <label for="username">
                        <span>Pseudo</span>
                        <input type="text" class="input_connexion second_form" name="username" id="username" required>
                    </label>
                </div>

                <!-- Input password -->
                <div class="input_container">
                    <label for="pswd">
                        <span>Mot de passe</span>
                        <input type="password" id="input_mdp" class="input_connexion input_mdp second_form" name="pswd"
                            id="psdw" required autocomplete="off">
                    </label>

                    <!-- To see the password -->
                    <div class="icon_eye" id="eye" alt=""></div>

                    <!-- Restriction -->

                    <!-- Icon restriction -->
                    <img class="icon_restriction" src="sources/img/restriction.svg" alt="">

                    <!-- Message restriction -->
                    <div class="restriction_container">
                        <p class="restriction">- 8 caractères minimum <br> - 1 majuscule au minimum </p>
                    </div>
                </div>



                <!-- Intput password confirmation -->
                <div class="input_container">
                    <label for="pswd">
                        <span>Confirmation du mot de passe</span>
                        <input type="password" id="input_mdp_validation"
                            class="input_connexion second_form input_mdp_verif" name="pswd_confirm" required
                            autocomplete="off">
                    </label>
                </div>

                <!-- Accept CGU -->
                <div class="checkbox_container">
                    <input id="CGU" type="checkbox" class="CGU_checkbox second_form" value="accepted" name="cgu"
                        required>
                    <label for="CGU" class="CGU_label">J'ai lu et j'accepte les <a href="" class="link"> conditions
                            générales d'utilisation</a></label>
                </div>

                <!-- Inscription button -->
                <button class="btn btn_inscription cannot_click" type="submit">S'inscrire</button>

            </div>

        </form>


        <!-- Form n°2 -->

        <!--⬇ En suspens, à mettre dans la page "email_verif.php" ⬇-->
        <!-- <form id="form2">
            <div class="form_container3"> -->

        <!-- Back arrow -->
        <!-- <svg class="btn_prev2" xmlns="http://www.w3.org/2000/svg" width="31.621" height="25.241"
                    viewBox="0 0 31.621 25.241">
                    <g class="fleche" id="Groupe_12" data-name="Groupe 12" transform="translate(-754.379 -406.379)">
                        <line class="line2" id="Ligne_12" data-name="Ligne 12" x1="0" x2="27"
                            transform="translate(756.5 418.5)" fill="none" stroke="#efe4ef" stroke-linecap="round"
                            stroke-width="3" />
                        <line class="line2" id="Ligne_13" data-name="Ligne 13" y1="10" x2="10"
                            transform="translate(756.5 408.5)" fill="none" stroke="#efe4ef" stroke-linecap="round"
                            stroke-width="3" />
                        <line class="line2" id="Ligne_14" data-name="Ligne 14" x2="10" y2="10.9"
                            transform="translate(756.5 418.6)" fill="none" stroke="#efe4ef" stroke-linecap="round"
                            stroke-width="3" />
                    </g>
                </svg> -->

        <!-- Input validation code -->
        <!-- <p id="mail">Entre le code de validation envoyé à : <span class="mailcontainer"></span> </p>
                <div class="input_confirm_container">
                    <input class="input_connexion input_confirm third_form" type="text" pattern="[0-9]{1}" name="code1"
                        required>
                    <input class="input_connexion input_confirm third_form" type="text" pattern="[0-9]{1}" name="code2"
                        required>
                    <input class="input_connexion input_confirm third_form" type="text" pattern="[0-9]{1}" name="code3"
                        required>
                    <input class="input_connexion input_confirm third_form" type="text" pattern="[0-9]{1}" name="code4"
                        required>
                    <input class="input_connexion input_confirm third_form" type="text" pattern="[0-9]{1}" name="code5"
                        required>
                    <input class="input_connexion input_confirm third_form" type="text" pattern="[0-9]{1}" name="code6"
                        required>
                </div> -->

        <!-- Link haven't received the code.  -->
        <!-- <a href="" class="link">Je n'ai pas reçu de code</a> -->

        <!-- Validation button -->
        <!-- <button class="btn btn_connexion cannot_click">Valider</button>
            </div>
        </form> -->

        <!-- CGU -->
        <a href="cgu.php" class="CGU">CGU<a>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/register.js"></script>

</body>

</html>