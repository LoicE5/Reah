<?php

    if(isset($_GET['id']) && isset($_GET['key']))

    {

        require_once "db.php";
        
        $stmt = $db -> prepare("SELECT * FROM ho_users WHERE id = :id AND reset_key IS NOT NULL AND reset_key = :reset_key AND reset_at > DATE_SUB(NOW(), INTERVAL 60 MINUTE)");
        $stmt -> execute(array(

            "id" => $_GET['id'],
            "reset_key" => $_GET['key']

        ));
        $user = $stmt -> fetch();

        if($user)

        {

            if(!empty($_POST))

            {

                if(!empty($_POST['pswd']) && $_POST['pswd'] == $_POST['pswd_confirm'])

                {

                    $password = password_hash($_POST['pswd'], PASSWORD_BCRYPT);

                    $db -> prepare("UPDATE ho_users SET `password` = :pswd, reset_at = NULL, reset_key = NULL WHERE id = :id") -> execute(array(

                        "pswd" => $password,
                        "id" => $user -> id

                    ));

                    echo"mdp modifié";

                }

            }

        }

        else

        {

            echo "erreur";
            die();

        }

    }

    else

    {

        echo "erreur";
        die();

    }

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Changement de mot de passe</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/inscription.css">
    <link rel="stylesheet" href="public/assets/css/mdp_chgmt.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <main class="main_content">

        <!-- Background video -->
        <video class="background_video" poster="" autoplay loop muted>
            <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
        </video>

        <!-- Form -->
        <form class="form_container" action="" method="POST">

            <!-- Sentence -->
            <p>Rentre ton nouveau mot de passe.</p>

            <!-- Input new password -->
            <div class="input_container">
                <label for="input_mdp">
                    <span>Nouveau mot de passe</span>
                    <input type="password" class="input_connexion input_mdp" id="input_mdp" name="pswd"  required autocomplete="off">
                </label>
            </div>

            <!-- Input new password validation-->
            <div class="input_container">
                <label for="input_mdp_validation">
                    <span>Confirmer le nouveau mot de passe</span>
                    <input type="password" class="input_connexion mdp_confirm" id="input_mdp_validation" name="pswd_confirm" required autocomplete="off">
                </label>
            </div>

            <!-- To see the password -->
            <div class="icon_eye" id="eye" alt=""></div>

            <!-- Restriction -->

            <!-- Icon restriction -->
            <img class="icon_restriction" src="public/img/restriction.svg" alt="">

            <!-- Message restriction -->
            <div class="restriction_container">
                <p class="restriction">-8 caractères minimum <br> -1 majuscule et minuscule au minimum </p>
            </div>

            <!-- Button to send -->
            <button class="btn btn_connexion cannot_click">Valider</button>

        </form>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/mdp_chgmt.js"></script>
</body>

</html>