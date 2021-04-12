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

    $video_id = $_GET['id'];
    
    $query = "SELECT * FROM videos WHERE video_id = '$video_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $url = addslashes($_POST['url']);
    $title = addslashes($_POST['title']);
    $realisateur = addslashes($_POST['realisateur']);
    $synopsis = addslashes($_POST['synopsis']);
    $genre = addslashes($_POST['genre']);
    $defi = addslashes($_POST['defi']);
    $duration = addslashes($_POST['duration']);
    $date = addslashes($_POST['date']);
    $distribution = addslashes($_POST['distribution']);
    $like = addslashes($_POST['like']);
    $report = addslashes($_POST['report']);

    $content_dir_poster = 'database/videos_posters/';
    $tmp_file_poster = $_FILES['poster']['tmp_name'];
    $name_file_poster = basename($_FILES['poster']['name']);

    if ($_FILES["poster"]['error'] == 0 ) {

        if(!is_uploaded_file($tmp_file_poster)) {
            $message_false = "Le fichier est introuvable.";
        }
    
        if(!move_uploaded_file($tmp_file_poster, $content_dir_poster . $name_file_poster)){
            $message_false = "Impossible de copier le fichier dans notre dossier.";
        }

        $query = "UPDATE videos SET video_url='$url', video_title='$title', video_user_id='$realisateur', video_synopsis='$synopsis', video_poster='$name_file_poster', video_genre='$genre', video_defi_id='$defi', video_duration='$duration', video_date='$date', video_distribution='$distribution', video_like_number='$like', video_report_id='$report' WHERE video_id = '$video_id';";

    } else {
        $query = "UPDATE videos SET video_url='$url', video_title='$title', video_user_id='$realisateur', video_synopsis='$synopsis', video_genre='$genre', video_defi_id='$defi', video_duration='$duration', video_date='$date', video_distribution='$distribution', video_like_number='$like', video_report_id='$report' WHERE video_id = '$video_id';";
        
    }
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $message_true='Le court-métrage '.$row['video_title'].' a bien été modifié.';
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
            MODIFIER LE COURT-MÉTRAGE

            <!-- Nbr de users -->
            <?php 

if (isset($_GET['id'])) {

    $video_id = $_GET['id'];

    $query = "SELECT * FROM videos WHERE video_id = '$video_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

}
               
        echo $row['user_username']
        ?>
        </h1>

        <form action="" method="POST" enctype='multipart/form-data'>
            <div class="all_input_container">
                <div class="input_container">
                    <label for="url">URL </label>
                    <input type="text" class="input_connexion" id="url" name="url"
                        value="<?php echo $row['video_url'];?>">

                </div>
                <div class="input_container">
                    <label for="title">Titre </label>
                    <input type="text" class="input_connexion" id="title" name="title"
                        value="<?php echo $row['video_title'];?>">

                </div>
                <div class="input_container">
                    <label for="realisateur">Réalisateur </label>
                    <input type="text" class="input_connexion" id="realisateur" name="realisateur"
                        value="<?php echo $row['video_user_id'];?>">

                </div>

                <div class="input_container">
                    <label for="synopsis">
                        Synopsis
                    </label>
                    <textarea class="input_connexion input_synopsis" id="synopsis" name="synopsis" cols="30"
                        rows="10"><?php echo $row['video_synopsis'];?></textarea>
                </div>
                <div class="input_container">
                    <label for="genre">Genre </label>
                    <input type="text" class="input_connexion" id="genre" name="genre"
                        value="<?php echo $row['video_genre'];?>">

                </div>
                <div class="input_container">
                    <label for="defi">Défi </label>
                    <input type="text" class="input_connexion" id="defi" name="defi"
                        value="<?php echo $row['video_defi_id'];?>">

                </div>
                <div class="input_container">
                    <label for="duration">Durée </label>
                    <input type="text" class="input_connexion" id="duration" name="duration"
                        value="<?php echo $row['video_duration'];?>">

                </div>
                <div class="input_container">
                    <label for="date">Date </label>
                    <input type="text" class="input_connexion" id="date" name="date"
                        value="<?php echo $row['video_date'];?>">

                </div>

                <?php 
                        
                        $video_url = $row['video_url'];
                        $query2 = "SELECT distribution_user_id, user_username FROM videos,distribution, users WHERE distribution_video_id = '1' AND video_id = '$video_id' AND distribution_user_id = user_id;";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();
                        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($rows2 as $row2){
                            echo '
                            <div class="input_container">
                    <label for="distribution">Distribution : '.$row2['user_username'].'</label>
                            <input type="text" class="input_connexion" id="distribution" name="distribution"
                            value="'.$row2['distribution_user_id'].'"></div><br>';
                        }
                        
                        
                        ?>


                <div class="input_container">
                    <label for="like">Likes</label>
                    <input type="text" class="input_connexion" id="like" name="like"
                        value="<?php echo $row['video_like_number'];?>">

                </div>

                <div class="input_container">
                    <label for="report">Signalement </label>
                    <input type="text" class="input_connexion" id="report" name="report"
                        value="<?php echo $row['video_report_id'];?>">

                </div>

                <div class="input_container">
                    <label for="poster">Poster </label>
                    <img src="database/videos_posters/<?php echo $row['video_poster'];?>" alt="" class="defi_img">
                    <input type="file" name="poster" id="poster" accept='.jpeg,.jpg,.png'>
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