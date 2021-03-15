<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Changement de mot de passe</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/inscription.css">
    <link rel="stylesheet" href="assets/css/mdp_chgmt.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <a href="fil_actu.php" class="reah_logo">
        <img src="sources/img/dark_reah_logo.png" alt="">
    </a>

    <main class="main_content">

        <!-- Background video -->
        <video class="background_video" poster="" autoplay loop muted>
            <source src="sources/video/videobackPT.mp4" type="video/mp4">
        </video>

        <!-- Form -->
        <form class="form_container" action="" method="POST">

            <!-- Back arrow -->
            <a href="mdp_oublie.php" class="btn_prev_mdp_oublie">
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
            <p>Rentre ton nouveau mot de passe.</p>

            <!-- Input new password -->
            <div class="input_container">
                <label for="input_mdp">
                    <span>Nouveau mot de passe</span>
                    <input type="password" class="input_connexion input_mdp" id="input_mdp" name="pswd" required
                        autocomplete="off">
                </label>
            </div>

            <!-- Input new password validation-->
            <div class="input_container">
                <label for="input_mdp_validation">
                    <span>Confirmer le nouveau mot de passe</span>
                    <input type="password" class="input_connexion mdp_confirm" id="input_mdp_validation"
                        name="pswd_confirm" required autocomplete="off">
                </label>
            </div>

            <!-- To see the password -->
            <div class="icon_eye" id="eye" alt=""></div>

            <!-- Restriction -->

            <!-- Icon restriction -->
            <img class="icon_restriction" src="sources/img/restriction.svg" alt="">

            <!-- Message restriction -->
            <div class="restriction_container">
                <p class="restriction">-8 caractères minimum <br> -1 majuscule et minuscule au minimum </p>
            </div>

            <!-- Button to send -->
            <button class="btn btn_connexion cannot_click">Valider</button>

        </form>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/mdp_chgmt.js"></script>
</body>

</html>