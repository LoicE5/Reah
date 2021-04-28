<?php
    include('assets/php/config.php');


    function check_mdp_format($mdp)
{
	$majuscule = preg_match('@[A-Z]@', $mdp);
	$minuscule = preg_match('@[a-z]@', $mdp);
	
	if(!$majuscule || !$minuscule || strlen($mdp) < 8)
	{
		return false;
	}
	else 
		return true;
}

$user_email = $_GET['email'];

$query = "SELECT * FROM users WHERE user_email = '$user_email';";

$stmt = $db->prepare($query);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!isset($_GET['email'])){
    redirect('mdp_oublie.php');
} else {
    if(count($row['user_email']) < 1){
        redirect('mdp_oublie.php');
    }
    
}

// var_dump(count($row['user_email']));

// Changer son mdp
if(isset($_POST["change_mdp_btn"])){
    
        
        
        if($_POST['new_mdp'] == $_POST['confirm_mdp']){
            
            
            if (check_mdp_format($_POST['new_mdp']) == true){

   
                    
    if(password_verify($_POST["new_mdp"], $row['user_password']) == false){



        $password = password_hash($_POST['new_mdp'], PASSWORD_DEFAULT);
    
        $sql = "UPDATE users SET user_password='$password' WHERE user_email='$user_email'";
    
    
        $stmt = $db->prepare($sql);
    
        $stmt->execute();
    
    // var_dump($_POST['new_mdp']);
    // var_dump($_POST['confirm_mdp']);
    // var_dump($user_email);
    // var_dump($row['user_password']);
        header("Location: login.php?mdp=true");
    } else {
        $message_false = 'Vous avez utilisé ce mot de passe récemment. Veuillez en choisir un autre.';

    }
        
                
                } else{
                    $message_false = 'Votre mot de passe doit contenir au moins 8 caractères dont 1 majuscule et 1 minuscule';
                }
            } else {
                $message_false = 'Verifiez que les deux mots de passe correspondent.';
            }
}
// }
?>

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

<?php
    if (isset($message_false)) {
        echo '<p class="message_false_container">'.$message_false.'</p>';
    }
    ?>

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
                    <input type="password" class="input_connexion input_mdp" id="input_mdp" name="new_mdp" required
                        autocomplete="off">
                        <p class="mdp_restriction">*8 caractères / 1 majuscule / 1 minuscule</p>
                </label>
            </div>

            <!-- Input new password validation-->
            <div class="input_container">
                <label for="input_mdp_validation">
                    <span>Confirmer le nouveau mot de passe</span>
                    <input type="password" class="input_connexion mdp_confirm" id="input_mdp_validation"
                        name="confirm_mdp" required autocomplete="off">
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
            <input type='submit' class="btn btn_connexion" name="change_mdp_btn" value="Valider">

        </form>
    </main>

    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/mdp_chgmt.js"></script>
</body>

</html>