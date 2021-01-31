<?php

if(!empty($_POST) && isset($_POST) &&  !empty($_POST['email']))

{

    require_once "db.php";
    require_once "app.php";

    $success = false;

    $stmt = $db -> prepare("SELECT * FROM ho_users WHERE email = :email AND confirmed_email IS NOT NULL");
    $stmt -> execute(array(

         'email' => $_POST['email']

    ));
    $userEmail = $stmt -> fetch();

    if($userEmail)

    {

        $reset_key = bin2hex(random_bytes (30));
        $db -> prepare("UPDATE ho_users SET reset_key = :reset_key, reset_at = NOW() WHERE id = :id") -> execute(array(

            'reset_key' => $reset_key,
            'id' => $userEmail -> id

        ));

        mail($_POST['email'], 'Réinitialisation du mot de passe', "Voici le lien de réinitialisation de ton mot de passe :\n\n http://localhost/web-hovi/mdp_chgmt.php?id={$userEmail -> id}&key=$reset_key");
        
        $success = true;

    }

}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Oublie de mot de passe</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/mdp_oublie.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <main class="main_content">

        <!-- Background video -->
        <video class="background_video" poster="" autoplay loop muted>
            <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
        </video>

        <!-- Success/error message -->
        <?php if(isset($success) && $success): ?>
            <div class="alert_message_container">
                <div class="alert_message success_message">Un mail a été envoyé à <?= $_POST['email'] ?></div>
            </div>
        <?php endif ?>

        <?php if(isset($success) && !$success): ?>
            <div class="alert_message_container">
                <div class="alert_message">Aucun compte ne corrrespond à cette adresse mail.</div>
            </div>
        <?php endif ?>

        <!-- Form -->
        <form class="form_container" method="post" action="mdp_oublie.php">

            <!-- Back arrow -->
            <a href="connexion.php" class="btn_prev_mdp_oublie">
                <svg xmlns="http://www.w3.org/2000/svg" width="31.621" height="25.241" viewBox="0 0 31.621 25.241">
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
            </a>

            <!-- Sentence -->
            <p>Renseigne ton adresse mail pour réinitialiser son mot de passe.</p>

            <!-- Input E-mail -->
            <div class="input_container">
                <label for="mail">
                    <span>Adresse mail</span>
                    <input type="email" class="input_connexion input_email" id="mail" name="email" required>
                </label>
            </div>

            <!-- Button to send -->
            <button class="btn btn_connexion cannot_click">Envoyer</button>

        </form>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/mdp_oublie.js"></script>
</body>

</html>