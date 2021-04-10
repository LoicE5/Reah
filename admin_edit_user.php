<?php
    include('assets/php/config.php');

    if(func::checkLoginState($db)){ # If the user isn't connected
        $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['user_admin'] >0){

        }else {
            
            redirect('login.php');
        }
        
    } else {
        redirect('login.php');
    }
?>
<?php




if (isset($_POST['modify_btn'])) {

    $user_id = $_GET['id'];
    
    $query = "SELECT * FROM users WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $lastname = addslashes($_POST['lastname']);
    $firstname = addslashes($_POST['firstname']);
    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    $birthday = addslashes($_POST['birthday']);
    $profile_picture = addslashes($_POST['profile_picture']);
    $banner = addslashes($_POST['banner']);
    $name = addslashes($_POST['name']);
    $website = addslashes($_POST['website']);
    $bio = addslashes($_POST['bio']);
    $report = addslashes($_POST['report']);
    $admin = addslashes($_POST['admin']);
    
    $query = "UPDATE users SET user_lastname='$lastname', user_firstname='$firstname', user_username='$username', user_email='$email', user_birthday='$birthday', user_profile_picture='$profile_picture', user_banner='$banner', user_name='$name', user_website='$website', user_bio='$bio', user_report_id='$report', user_admin='$admin' WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $message_true='L\'utilisateur '.$row['user_username'].' a bien été modifié.';
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Profil</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/fullpage.css" />
    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/functions.js" defer></script>
    <script src="assets/js/fil_actu.js" defer></script>


</head>

<body>

<?php
if (isset($message_true)) {
        echo '
        <p class="message_true_container">'
                .$message_true.
        '</p>';
    }
    ?>

    <!-- Navigation menu -->
    <nav>

        <!-- Logo Réah -->
        <a href="fil_actu.php" class="reah_logo"></a>

        <div class="menu_nav">
            
            <!-- Search bar -->
            <form action="search.php" method="GET" class="form_search_bar">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs..."
                    oninput="searchEngine(this.value)">
            </form>

            <?php
                if (func::checkLoginState($db)) { # If the user is connected
                    $query2 = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
                    $stmt2 = $db->prepare($query2);
                    $stmt2->execute();

                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                    echo "<div class='menu_profile'>
                        <!-- Fil actu icon -->
                        <form action='fil_actu.php' method='GET' style='margin-bottom:0'>
                            <button type='submit' name='accueil' class='fil_actu_icon' value='true'></button>
                        </form>
                        <!-- Defi icon -->
                        <a href='defis.php' class='defi_icon' alt=''></a>
                        <!-- Profile photo -->
                        <img src='database/profile_pictures/".$row2['user_profile_picture']."' class='menu_pp' onclick='toggleBurgerMenu()'>
                        </div>
                        </nav>";
                } else {
                    redirect('login.php');
                }
                ?>
        </div>
    </nav>

    <!-- Menu -->
    <?php
            require("ressources/menu.php");
        ?>

    <main class="main_content">

        <h1 class="back_office_title"><a href="admin.php">BACK-OFFICE</a> </h1>


        <!-- UTILISATEURS -->

        <!-- Category title -->
        <h1 class="title1" id="title1">
            <div class="red_line title_line"></div>
            MODIFIER L'UTILISATEUR

                <!-- Nbr de users -->
            <?php 

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $query = "SELECT * FROM users WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

}
               
        echo $row['user_username']
        ?>
        </h1>

                        <form action="" method="POST">
                            <div class="all_input_container">
                                <div class="input_container">
                                    <label for="lastname">Nom de famille </label>
                                        <input type="text" class="input_connexion" id="lastname" name="lastname"
                                            value="<?php echo $row['user_lastname'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="firstname">Prénom </label>
                                        <input type="text" class="input_connexion" id="firstname" name="firstname"
                                            value="<?php echo $row['user_firstname'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="username">Pseudo </label>
                                        <input type="text" class="input_connexion" id="username" name="username"
                                            value="<?php echo $row['user_username'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="email">Email </label>
                                        <input type="text" class="input_connexion" id="email" name="email"
                                            value="<?php echo $row['user_email'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="birthday">Date de naissance </label>
                                        <input type="text" class="input_connexion" id="birthday" name="birthday"
                                            value="<?php echo $row['user_birthday'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="profile_picture">Photo de profil </label>
                                        <input type="text" class="input_connexion" id="profile_picture" name="profile_picture"
                                            value="<?php echo $row['user_profile_picture'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="banner">Bannière </label>
                                        <input type="text" class="input_connexion" id="banner" name="banner"
                                            value="<?php echo $row['user_banner'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="name">Nom </label>
                                        <input type="text" class="input_connexion" id="name" name="name"
                                            value="<?php echo $row['user_name'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="website">
                                        Site web
                                    </label>
                                        <input type="text" class="input_connexion" id="website" name="website"
                                            value="<?php echo $row['user_website'];?>">
                                </div>
                                <div class="input_container">
                                    <label for="bio">
                                        Biographie
                                    </label>
                                        <textarea class="input_connexion input_bio" id="bio" name="bio" cols="30"
                                            rows="10"><?php echo $row['user_bio'];?></textarea>
                                </div>
                                <div class="input_container">
                                    <label for="report">Signalement </label>
                                        <input type="text" class="input_connexion" id="report" name="report"
                                            value="<?php echo $row['user_report_id'];?>">
                                   
                                </div>
                                <div class="input_container">
                                    <label for="admin">Admin </label>
                                        <input type="text" class="input_connexion" id="admin" name="admin"
                                            value="<?php echo $row['user_admin'];?>">
                                   
                                </div>
                            </div>

                            <input type="submit" class="btn modify_btn" name="modify_btn" value="Modifier">
                        </form>
    </main>

    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>