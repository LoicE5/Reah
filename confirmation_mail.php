<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hovi | Inscription</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/confirmation_mail.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <main class="main_content">
        <form action="">
            <!-- Message code incorrect -->
            <div class="alert_message_container">
                <div class="alert_message">Code incorrecte ! Il te reste 4 essais</div>
            </div>
            <div class="form_container">
                <p>Entre le code de validation envoyé à : </p>
                <div class="input_container">
                    <input class="input_connexion" type="text" pattern="[a-zA-Z0-9]{1}" name="code1" required>
                    <input class="input_connexion" type="text" pattern="[a-zA-Z0-9]{1}" name="code2" required>
                    <input class="input_connexion" type="text" pattern="[a-zA-Z0-9]{1}" name="code3" required>
                    <input class="input_connexion" type="text" pattern="[a-zA-Z0-9]{1}" name="code4" required>
                    <input class="input_connexion" type="text" pattern="[a-zA-Z0-9]{1}" name="code5" required>
                    <input class="input_connexion" type="text" pattern="[a-zA-Z0-9]{1}" name="code6" required>
                </div>
                <a href="" class="link">Je n'ai pas reçu de code</a>
                <button class="btn btn_connexion">Valider</button>
            </div>
        </form>
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/app.js"></script>
</body>

</html>