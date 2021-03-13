<?php include('assets/php/config.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Connexion</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/connexion.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

</head>

<body>
    <?php
        if( !func::checkLoginState($db) ){ # If the user isn't logged in
            
            if( (isset($_POST['username']) && isset($_POST['password'])) && ($_POST['username'] != '' && $_POST['password'] != '')) { # If the username and password fields are filled in

                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                # We get the matching username and passwords from the database
                $query = "SELECT * FROM users WHERE user_username = '$username';";

                $stmt = $db->prepare($query);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($row['user_id'] > 0){ # If the user's form fields data matches the database informations

                    if(password_verify($password, $row['user_password']) == true){

                        echo '<h1>CONNECTED</h1>';
                        func::createRecord($db,$row['user_username'],$row['user_id']); # Deleting from sessions the previous username & user_id & creating new cookies & session.
                        redirect('fil_actu.php?accueil=true');
                    } else {
                        echo '<h1 style="color:red">ERROR : password doesn"t match !</h1>';
                    }

                } else { # if the credentials are unknwown from the database

                    consoleLog($password);
                    consoleLog($row['user_password']);
                    consoleLog(password_verify($password, $row['user_password']));

                    echo 'error';
                }

            } else { # We display the form in order to make the user fill the fields
                makeVisible('main.main_content',true);
            }
        } else { # If the user is logged in, we redirect him to the index.php
            redirect('fil_actu.php?accueil=true');
        }
    ?>
    <main class="main_content" style="visibility: hidden;">

        <!-- Background video -->
        <video class="background_video" poster="" autoplay loop>
            <source src="sources/video/videobackPT.mp4" type="video/mp4">
        </video>

        <!-- Form -->
        <form class="form_container" action="" method="POST">

            <!-- Google button -->
            <div class="btn google_btn">Se connecter avec Google</div>

            <!-- "Or" section -->
            <div class="ou_section">
                <div class="line"></div>
                <p>OU</p>
                <div class="line"></div>
            </div>

            <!-- Input Pseudo/E-mail -->
            <div class="input_container">
                <label for="pseudo">
                    <span>Pseudo/E-mail</span>
                    <input type="text" class="input_connexion input_email" id="pseudo" name="username">
                </label>
            </div>

            <!-- Input password -->
            <div class="input_container">
                <label for="mdp">
                    <span>Mot de passe</span>
                    <input type="password" class="input_connexion" id="mdp" name="password">
                </label>
            </div>

            <!-- Input to stay logged in -->
            <div class="checkbox_container">
                <input id="connexion" type="checkbox" class="checkbox">
                <label for="connexion" class="checkbox_label">Rester connecté</label>
            </div>

            <!-- Link  forgotten psw -->
            <a href="mdp_oublie.php" class="link">Mot de passe oublié ?</a>

            <!-- Button get logged -->
            <button class="btn btn_connexion">Se connecter</button>

            <!-- Link to register  -->
            <a href="signup.php" class="link">S'inscrire</a>
        </form>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>