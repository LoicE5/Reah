<?php
    include('assets/php/config.php');
    // require("ressources/pop_up_film_information.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAH | Mentions légales</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/cgu.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/fullpage.css" />
    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/functions.js" defer></script>
</head>

<body>
    <main class="main_content">

        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a href="fil_actu.php" class="reah_logo"></a>

            <!-- Search bar -->
            <form action="search.php" method="GET" class="form_search_bar">
                    <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs..." oninput="searchEngine(this.value)">
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
                    echo "<div class='menu_profile'>
                    <!-- Fil actu icon -->
                    <form action='fil_actu.php' method='GET'>
                        <button type='submit' name='accueil' class='fil_actu_icon' value='true'></button>
                    </form>
                    <!-- Defi icon -->
                    <a href='defis.php' class='defi_icon'></a>
                    <!-- Profile photo -->
                    <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'>

                    </div>
                    </nav>";
                }
            ?>
        </nav>

        <!-- Menu -->
        <?php
            require("ressources/menu.php");
        ?>

        <div class="cgu_text">

            <h1>
                <div class="red_line title_line"></div>
                Bienvenue à toi sur Reah !
            </h1>

            <p>Reah c’est un concept unique. Notre objectif est de vous permettre en tant que réalisateurs débutants
                et⸱ou professionnels de partager vos courts-métrages, avec un petit twist. Chez Reah, nous souhaitons
                vous pousser vers l’avant en vous proposant de relever nos défis avec des contraintes filmiques et des
                thèmes de tous les genres. Nous voulons stimuler votre esprit créatif en vous permettant de gagner en
                visibilité en gagnant une médaille sur le podium.</p>

            <h1>
                <div class="red_line title_line"></div>
                Qui peut utiliser Reah ?
            </h1>
            <p id="mentions">Pour utiliser Reah, vous devez avoir au moins 16 ans. Vous devez avoir obtenu le consentement de votre
                parent
                ou tuteur légal, si vous êtes plus jeune.</p>

            <h1>
                <div class="red_line title_line"></div>
                Autorisations et restrictions Générales
            </h1>


            <p>Vous pouvez accéder au service et l’utiliser tel qu'il vous est proposé sous condition de respecter les
                règles.</p>
            <p>Les restrictions suivantes s'appliquent à votre utilisation du service. Vous n'êtes pas autorisé à : </p>
            <ul>
                <li>vendre, concéder sous licence, altérer, modifier ou utiliser de toute autre façon tout ou partie du
                    Service ou du Contenu sauf si le service vous y a explicitement autorisé, par écrit</li>
                <li>usurper l’identité d’autrui</li>
                <li>accéder au Service par le biais de procédés automatisés (robots)</li>
                <li>recueillir ou utiliser toute information permettant d’identifier une personne</li>
                <li>abuser des options de rapports (signalements, accusations)</li>
                <li>utiliser le Service pour vendre de la publicité.</li>
            </ul>

            <p>Les conditions générales d’utilisation rappellent aux internautes que les éléments du site :</p>
            <ul>
                <li>textes</li>
                <li>vidéos</li>
                <li>images</li>
            </ul>

            <p>sont protégés par le droit d’auteur et que leur utilisation sans autorisation préalable expresse est
                interdite.</p>

            <h1>
                <div class="red_line title_line"></div>
                Les conditions générales
            </h1>

            <p>Le Service peut inclure des liens vers des sites web tiers qui n’appartiennent pas à Reah. Nous déclinons
                toute responsabilité quant à l’utilisation de ces sites que Reah ne gère pas.</p>

            <h2>Le règlement général sur la protection des données</h2>

            <p>Les informations recueillies sur le formulaire d’inscription sont enregistrées dans notre base de données
                informatisée par nos développeurs pour créer votre profil Reah.</p>

            <p>Les données collectées seront communiquées aux seuls destinataires suivants : Étienne Loïc, Saint Martin
                Julie, Bassimane Manar, Baillon Edouard et Lad Minal.</p>
            <p>Les données sont conservées jusqu’à la suppression souhaitée par l’utilisateur. En cas d’inactivité
                pendant 2
                ans entraînera la suppression du compte et des données.</p>
            <p>Vous pouvez accéder aux données vous concernant, les rectifier, demander leur effacement ou exercer votre
                droit à la limitation du traitement de vos données. Vous pouvez retirer à tout moment votre consentement
                au
                traitement de vos données ; Vous pouvez également vous opposer au traitement de vos données ; Vous
                pouvez
                également exercer votre droit à la portabilité de vos données.</p>
            <p>Consultez le site <a target="_blank" href="https://www.cnil.fr">cnil.fr </a> pour plus d’informations sur vos droits.</p>
            <p>Pour exercer ces droits ou pour toute question sur le traitement de vos données dans ce dispositif, vous
                pouvez contacter <a target="_blank" href="mailto:reahapp.fr@gmail.com" class="not_a_link">reahapp.fr@gmail.com</a>.</p>

            <p>Si vous estimez, après nous avoir contactés, que vos droits « Informatique et Libertés » ne sont pas
                respectés, vous pouvez adresser une réclamation à la CNIL.</p>

            <h2>COOKIES (Cookies : fichiers témoins déposés sur votre système.)</h2>

            <p>Lorsque vous créez un compte ou vous connectez sur Reah, des Cookies peuvent être déposés sur votre
                système.
                Ces derniers assurent le bon fonctionnement du site et sont essentiels à une navigation et une
                expérience
                utilisateur optimale. </p>

            <p>Aucun Cookie ne sera déposé sur votre système sans que : </p>

            <ul>
                <li>Vous ayez créé ou tenté de créer un compte sur la plateforme Reah </li>
                <li>Vous n'ayez été promptement invité à donner votre consentement pour l'utilisation de ces derniers,
                    via
                    une affiche clairement visible vous proposant d'accepter ou de refuser les Cookies, et que vous les
                    ayez
                    explicitement acceptés, conformément à la loi Européenne sur la protection des données (RGPD). </li>
            </ul>

            <p>En cas d'acceptation de cette dernière affiche survenant a priori de votre navigation sur le site, Reah
                est
                susceptible de déposer des cookies tiers à des fins d'analyse et de publicité. Vous avez bien sûr le
                choix
                de refuser ces derniers.</p>


            <h1>
                <div class="red_line title_line"></div>
                Les conditions générales d’utilisation
            </h1>
            <h2>Droits de l’utilisateur</h2>

            <p>Tous les utilisateurs peuvent créer un compte, s’ils souhaitent effectuer les actions suivantes : aimer,
                commenter, partager, s’abonner. <br>
                En cas d’oubli de mot de passe, l’utilisateur peut demander à le modifier. <br>
                Nous proposons un accès libre aux courts-métrages. Ainsi, toute personne ayant accès à la plateforme
                peut
                regarder des courts-métrages, sans avoir l’obligation de créer un compte.</p>

            <h2>Vous avez un compte ?</h2>

            <p>Pour la création du compte de l’utilisateur, la collecte des informations au moment de l’inscription sur
                le
                site est nécessaire et obligatoire.</p>
            <p>Vous pouvez vous abonner ou bien vous désabonner librement sans aucune notification. Vous pouvez
                également
                modifier vos informations personnelles, renseignées lors de votre inscription.</p>

            <p>Vous pouvez supprimer votre compte, ce qui supprimera automatiquement toutes vos données de notre
                plateforme.
                Toutes les informations recueillies lors de votre inscription ne sont pas transmises à un tiers. Nous
                les
                utilisons uniquement dans le cadre de votre authentification lors de votre connexion sur Reah.</p>

            <p>Vous avez la possibilité de signaler et de bloquer des utilisateurs dont les propos vous semblent
                inappropriés ou injurieux. Nous traiterons vos retours concernant cet utilisateur. Nous récupérerons les
                informations de l’utilisateur, pour effectuer les démarches nécessaires.</p>

            <h2>Partage des œuvres (courts-métrages)</h2>

            <p>En partageant vos travaux lors de nos défis :</p>

            <ul>
                <li>Vous devez mentionner toutes les personnes ayant participé à sa réalisation. </li>
                <li>Vous acceptez que les utilisateurs partagent vos travaux sur les réseaux sociaux ou d'autres
                    plateformes.</li>
                <li>Reah n’est pas responsable des plagiats et vols concernant vos travaux.</li>
                <li>Vous acceptez que vos travaux soient commentés.</li>
            </ul>

            <h2>Commentaires et partages</h2>

            <p>L’espace des commentaires en dessous des travaux est un espace de libre-échange. L’éditeur, notamment, ne
                sera pas tenu responsable en cas de propos injurieux ou de publication de contenu contrefaisant les
                droits
                de propriété intellectuelle d’un tiers.</p>

        </div>
    </main>

    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>