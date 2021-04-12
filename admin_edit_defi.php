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

    $defi_id = $_GET['id'];
    
    $query = "SELECT * FROM defis WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $name = addslashes($_POST['name']);
    $description = addslashes($_POST['description']);
    $date = addslashes($_POST['date']);
    // $image = addslashes($_POST['image']);
    $user = addslashes($_POST['user']);
    


    $content_dir_image = 'database/defis_img/';
    $tmp_file_image = $_FILES['image']['tmp_name'];
    $name_file_image = basename($_FILES['image']['name']);

    if ($_FILES["image"]['error'] == 0 ) {

        if(!is_uploaded_file($tmp_file_image)) {
            $message_false = "Le fichier est introuvable.";
        }
    
        if(!move_uploaded_file($tmp_file_image, $content_dir_image . $name_file_image)){
            $message_false = "Impossible de copier le fichier dans notre dossier.";
        }

        $query = "UPDATE defis SET defi_name='$name', defi_description='$description', defi_timestamp='$date', defi_image='$name_file_image', defi_user_id='$user' WHERE defi_id = '$defi_id';";

    } else {
        $query = "UPDATE defis SET defi_name='$name', defi_description='$description', defi_timestamp='$date', defi_user_id='$user' WHERE defi_id = '$defi_id';";
        
    }
    
    $stmt = $db->prepare($query);
    $stmt->execute();

    $message_true='Le défi '.$row['defi_name'].' a bien été modifié.';

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
    if (isset($message_false)) {
        echo '
        <p class="message_false_container">'
                .$message_false.
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
            MODIFIER LE DÉFI

            <!-- Nbr de users -->
            <?php 

if (isset($_GET['id'])) {

    $defi_id = $_GET['id'];

    $query = "SELECT * FROM defis WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

}
               
        echo $row['defi_name']
        ?>
        </h1>

        <form action="" method="POST" enctype='multipart/form-data'>
            <div class="all_input_container">
                <div class="input_container">
                    <label for="name">Titre </label>
                    <input type="text" class="input_connexion" id="name" name="name"
                        value="<?php echo $row['defi_name'];?>">

                </div>

                <div class="input_container">
                    <label for="description">Consignes </label>
                    <textarea class="input_connexion input_description" id="description" name="description" cols="30"
                        rows="10"><?php echo $row['defi_description'];?></textarea>
                </div>

                <div class="input_container">
                    <label for="date">Date </label>
                    <input type="text" class="input_connexion" id="date" name="date"
                        value="<?php echo $row['defi_timestamp'];?>">
                </div>

                
                <div class="input_container">
                    <label for="user">Utilisateur </label>
                    <input type="text" class="input_connexion" id="user" name="user"
                    value="<?php echo $row['defi_user_id'];?>">
                    
                </div>

                <div class="input_container">
                    <label for="image">Image </label>
                <img src="database/defis_img/<?php echo $row['defi_image'];?>" alt="" class="defi_img">
                <input type="file" name="image" id="image" accept='.jpeg,.jpg,.png'>
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