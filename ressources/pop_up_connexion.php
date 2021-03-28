<!DOCTYPE html>
<html lang="en">

<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head> -->

<body>
<div class="connexion_dark_filter" onclick="closePopupConnexion()"></div>


    <div class="pop_up_container connexion_container">
        <div class="pop_up_header">
            <h2>Tu n'es pas connecté.e !</h2>
            <img src='sources/img/close_icon.svg' class='connexion_close_icon' alt='' onclick="closePopupConnexion()">
        </div>
        <div class="pop_up_text">Connecte-toi afin de participer à la vie de REAH, tu pourras <nobr> ainsi : </nobr> <br>
            <ul class="connexion_list">
                <li>
                    Intéragir avec les autres utilisateurs
                </li>
                <li>Aimer, commenter et partager des courts-métrages </li>
                <li>
                    Proposer des défis
                </li>
                <li>
                    Avoir et personnaliser ton profil
                </li>
                <li>Participer aux défis et déposer tes courts-métrages</li>
            </ul>
            <br> 
            Tente ta chance de te faire connaître ou contribue au succès des autres !
        </div>
        <div class="btn_container">
            <a href="login.php" class="btn btn_connexion">Se connecter</a>
            <a href="signup.php" class="btn btn_connexion">S'inscrire</a>

        </div>
    </div>
</body>

</html>