<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Connexion</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/connexion.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

</head>

<body>
    <main class="main_content">

        <!-- Background video -->
        <video class="background_video" poster="" autoplay loop>
            <source src="public/sources/video/videobackPT.mp4" type="video/mp4">
        </video>

        <!-- Form -->
        <form class="form_container">

            <!-- Google button -->
            <div class="google_btn">Se connecter avec Google</div>

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
                    <input type="text" class="input_connexion input_email" id="pseudo">
                </label>
            </div>

            <!-- Input password -->
            <div class="input_container">
                <label for="mdp">
                    <span>Mot de passe</span>
                    <input type="password" class="input_connexion" id="mdp">
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
            <button class="btn_connexion">Se connecter</button>

            <!-- Link to register  -->
            <a href="public/index.php" class="link">S'inscrire</a>
        </form>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
</body>

</html>