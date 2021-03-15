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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';

$global_wrapper_visibility = false;


if( !func::checkLoginState($db) ){
    
    if(isset($_POST['code1']) 
    && isset($_POST['code2']) 
    && isset($_POST['code3']) 
    && isset($_POST['code4']) 
    && isset($_POST['code5']) 
    && isset($_POST['code6'])){
        
        
        
    } else {
        
        if(isset($_GET['client_email'])){
            $client_email = $_GET['client_email'];
        } else {
            consoleWarn('No email address specified as GET parameters.\nGET parameter : client_email');
        }
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'credential';
        $mail->Port = 'credential';
        $mail->isHTML();
        $mail->Username = 'credential';
        $mail->Password = 'credential';
        
        $mail->setFrom('no-reply@reah.fr');
        $mail->Subject = 'SUBJECT';
        $mail->Body = '<h1>A TEST EMAIL</h1>';
        $mail->AddAddress($client_email);
        
        $mail->send();
        
        // consoleLog($client_email);
        // consoleLog($mail->Host);
        // consoleLog($mail->Username);
        // consoleLog($mail->Password);
        
        $global_wrapper_visibility = true;
        
    }
    
} else {
    redirect('index.php');
}
?>

<main class="main_content">
<div id="global-wrapper">
    <!-- Background video -->
    <video class="background_video" poster="" autoplay loop muted>
            <source src="sources/video/videobackPT.mp4" type="video/mp4">
        </video>

    <form id="form2" action="" method="POST">


        <div class="form_container3" style="display: flex !important;">

                    <!-- Back arrow -->
            <svg class="btn_prev2" xmlns="http://www.w3.org/2000/svg" width="31.621" height="25.241"
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
            </svg>

            <!-- Input validation code -->
            <p id="mail">Entre le code de validation envoyé à <?php echo $client_email; ?> : <span class="mailcontainer"></span> </p>
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
            </div>

                    <!-- Link haven't received the code.  -->
                    <a href="" class="link">Je n'ai pas reçu de code</a>

                    <!-- Validation button -->
                    <button class="btn btn_connexion cannot_click">Valider</button>
                </div>
            </form>
        </div>
    </main>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/js/register.js"></script>

        <?php
            if($global_wrapper_visibility){
                makeVisible('#global-wrapper',true);
            }
        ?>
    </body>
</html>