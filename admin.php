<?php
    include('assets/php/config.php');
?>
<?php
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

// Suspension d'un utilisateur
if (isset($_GET['user_suspend'])) {

    $user_id = $_GET['user_suspend'];

    $query = "SELECT * FROM users WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    $query = "UPDATE users SET user_suspended='1' WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    
    $message_true='L\'utilisateur '.$row['user_username'].' a bien été suspendu.';
}

// Désuspension d'un utilisateur
if (isset($_GET['user_suspend_true'])) {

    $user_id = $_GET['user_suspend_true'];

    $query = "SELECT * FROM users WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    $query = "UPDATE users SET user_suspended='0' WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    
    $message_true='L\'utilisateur '.$row['user_username'].' a bien été désuspendu.';
}

// Supression d'un utilisateur
if (isset($_GET['user_delete'])) {

    $user_id = $_GET['user_delete'];
    
    $query = "SELECT user_username FROM users WHERE user_id = '$user_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sql = "DELETE FROM users WHERE user_id='$user_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    
    $message_true='L\'utilisateur '.$row['user_username'].' a bien été supprimé.';

}


// Supression d'un court-métrage
if (isset($_GET['video_delete'])) {

    $video_id = $_GET['video_delete'];
    
    $query = "SELECT video_title FROM videos WHERE video_id = '$video_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sql = "DELETE FROM videos WHERE video_id='$video_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    
    $message_true='Le court-métrage '.$row['video_title'].' a bien été supprimé.';

}

// Supression d'un défi
if (isset($_GET['defi_delete'])) {

    $defi_id = $_GET['defi_delete'];
    
    $query = "SELECT defi_name FROM defis WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sql = "DELETE FROM defis WHERE defi_id='$defi_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    
    $message_true='Le défi '.$row['defi_name'].' a bien été supprimé.';

}

// Validation d'un défi
if (isset($_GET['defi_verified'])) {

    $defi_id = $_GET['defi_verified'];

    $query = "SELECT * FROM defis WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    $query = "UPDATE defis SET defi_verified='1' WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    
    $message_true='Le défi '.$row['defi_name'].' a bien été validé.';
}

// Désuspension d'un utilisateur
if (isset($_GET['defi_verified_true'])) {

    $defi_id = $_GET['defi_verified_true'];

    $query = "SELECT * FROM defis WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    $query = "UPDATE defis SET defi_verified='0' WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    
    $message_true='Le défi '.$row['defi_name'].' a bien été dévalidé.';
}

// Ajouter le défi aux défis actuels
if (isset($_GET['defi_current'])) {

    $defi_id = $_GET['defi_current'];

    $query = "SELECT * FROM defis WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    $query = "UPDATE defis SET defi_current='1' WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    
    $message_true='Le défi '.$row['defi_name'].' a bien été ajouté aux défis du moment.';
}

// Enlever le défi aux défis actuels
if (isset($_GET['defi_current_true'])) {

    $defi_id = $_GET['defi_current_true'];

    $query = "SELECT * FROM defis WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    $query = "UPDATE defis SET defi_current='0' WHERE defi_id = '$defi_id';";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    
    $message_true='Le défi '.$row['defi_name'].' a bien été enlevé des défis du moment.';
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
            <!-- Categories's title -->
            <div class="menu_category">
                <p class="category_title category_title1" number="1" number1="2" number2="3">Utilisateurs</p>
                <p class="category_title category_title2" number="2" number1="1" number2="3">Courts-métrages</p>
                <p class="category_title category_title3" number="3" number1="1" number2="2">Défis</p>
                <div class="red_line underline"></div>
                <div class="fb_jsb ai-c category_list">
                    <p class="category_list_title">Catégories</p>
                    <div class="category_triangle"></div>
                </div>
            </div>

            <!-- Search bar -->
            <form action="search.php" method="GET" class="form_search_bar">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs..."
                    oninput="searchEngine(this.value)">
            </form>

            <?php
                if (func::checkLoginState($db)) { # If the user is connected
                    $query = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo "<div class='menu_profile'>
                        <!-- Fil actu icon -->
                        <form action='fil_actu.php' method='GET'>
                            <button type='submit' name='accueil' class='fil_actu_icon' value='true'></button>
                        </form>
                        <!-- Defi icon -->
                        <a href='defis.php' class='defi_icon' alt=''></a>
                        <!-- Profile photo -->
                        <img src='database/profile_pictures/".$row['user_profile_picture']."' class='menu_pp' onclick='toggleBurgerMenu()'>
                        </div>
                        </nav>";
                } else {
                    redirect('login.php');
                }
                ?>
        </div>
    </nav>

    <!-- Category list  -->
    <div class="category_list_container">
        <p class="category_list_category category_list_category1" number="1" number1="2" number2="3">Utilisateurs</p>
        <p class="category_list_category category_list_category2" number="2" number1="1" number2="3">Courts-métrages</p>
        <p class="category_list_category category_list_category3" number="3" number1="1" number2="2">Défis</p>
    </div>

    <!-- Menu -->
    <?php
            require("ressources/menu.php");
        ?>

    <main class="main_content">

        <h1 class="back_office_title">BACK-OFFICE</h1>


        <!-- UTILISATEURS -->

        <!-- Category title -->
        <h1 class="title1" id="title1">
            <div class="red_line title_line"></div>
            UTILISATEURS

                <!-- Nbr de users -->
            <?php 
                        
                        $query = "SELECT COUNT(*) as nbr FROM users;";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo '('.$row['nbr'].')'
        ?>
        </h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Anniv</th>
                    <th>Report</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $query = "SELECT * FROM users;";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row){
            echo'
            <tr id="'.$row['user_id'].'">
           
                        <td>'.$row['user_id'].'</td>
                        <td>'.$row['user_lastname'].'</td>
                        <td>'.$row['user_firstname'].'</td>
                        <td> <a href="profil.php?id='.$row['user_id'].'">'.$row['user_username'].' </a></td>
                        <td>'.$row['user_email'].'</td>
                        <td>'.$row['user_birthday'].'</td>
                        <td>'.$row['user_report_id'].'</td>
                        <td>
                            <form method="GET">
                            <button><a href="admin_edit_user.php?id='.$row['user_id'].'" class="action_edit">Modifier</a></button>';

                            if($row["user_suspended"] == 1){
                                echo'<button type="submit" name="user_suspend_true" value="'.$row['user_id'].'" class="action_suspend_true">Désuspendre</button>';

                            }else{
                                echo'<button type="submit" name="user_suspend" value="'.$row['user_id'].'" class="action_suspend">Suspendre</button>';
                            }

                            echo'
                            <button type="submit" name="user_delete" value="'.$row['user_id'].'" class="action_delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    ';

        }
                   

                    ?>
            </tbody>
        </table>

        <!-- COURTS-METRAGES -->

        <!-- Category title -->
        <h1 class="title2" id="title2">
            <div class="red_line title_line"></div>
            COURTS-MÉTRAGES

                <!-- Nbr de court-métrage -->

            <?php 
                        
                        $query = "SELECT COUNT(*) as nbr FROM videos;";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo '('.$row['nbr'].')'
        ?>
        </h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Titre</th>
                    <th>Réalisateur</th>
                    <th>Distribution</th>
                    <th>Synopsis</th>
                    <th>Genre</th>
                    <th>Défi</th>
                    <th>Date</th>
                    <th>Likes</th>
                    <th>Report</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $query = "SELECT * FROM videos, users, defis WHERE video_user_id = user_id AND video_defi_id = defi_id;";
                // distribution_user_id = user_id AND distribution_video_id = video_id AND
        $stmt = $db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row){
            echo'
            <tr id="'.$row['video_id'].'">
           
                        <td>'.$row['video_id'].'</td>
                        <td> <a href="https://player.vimeo.com/video/'.$row['video_url'].'">'.$row['video_url'].'</a></td>
                        <td>'.$row['video_title'].'</td>
                        <td> <a href="profil.php?id='.$row['user_id'].'">'.$row['user_username'].' </a></td>
                        <td>';

                        $query2 = "SELECT user_username, user_id FROM videos, users, distribution WHERE distribution_user_id = user_id AND distribution_video_id = video_id AND video_id = ".$row['video_id'].";";
                $stmt2 = $db->prepare($query2);
                $stmt2->execute();
        
                $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows2 as $row2){

                        echo '<a href="profil.php?id='.$row2['user_id'].'">'.$row2['user_username'].'</a><br>';
                }
                        echo'
                        </td>
                        <td>'.nl2br($row['video_synopsis']).'</td>
                        <td>'.$row['video_genre'].'</td>
                        <td>'.$row['defi_name'].'</td>
                        <td>'.date('d/m/Y', strtotime($row['video_date'])).'</td>
                        <td>'.$row['video_like_number'].'</td>
                        <td>'.$row['video_report_id'].'</td>
                        <td>
                            <form method="GET">
                            <button><a href="admin_edit_video.php?id='.$row['video_id'].'" class="action_edit">Modifier</a></button>
                            <button type="submit" name="video_delete" value="'.$row['video_id'].'" class="action_delete">Supprimer</button>
                            </form>
                        </td>
                        
                        </tr>
                    ';

        }
                   

                    ?>
            </tbody>
        </table>


        <!-- DEFIS -->

        <!-- Category title -->
        <h1 class="title3" id="title3">
            <div class="red_line title_line"></div>
            DÉFIS

                <!-- Nbr de défis -->
                <?php 
                        
                        $query = "SELECT COUNT(*) as nbr FROM defis;";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo '('.$row['nbr'].')'
        ?>
        </h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Consignes</th>
                    <th>Date</th>
                    <th>Temps restant</th>
                    <th>Utilisateur</th>
                    <th>Validé</th>
                    <th>Du moment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $query = "SELECT * FROM users, defis WHERE defi_user_id = user_id;";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row){
            echo'
            <tr id="'.$row['defi_id'].'">
           
                        <td>'.$row['defi_id'].'</td>
                        <td>'.$row['defi_name'].'</td>
                        <td>'.nl2br($row['defi_description']).'</td>
                        <td>'.date('d/m/Y à H\hm\ms\s', strtotime($row['defi_timestamp'])).'</td>
                        <td>'.date('d/m/Y à H\hm\ms\s', strtotime($row['defi_timestamp'])).'</td>
                        <td> <a href="profil.php?id='.$row['user_id'].'">'.$row['user_username'].' </a></td>
                        <td>'.$row['defi_verified'].'</td>
                        <td>'.$row['defi_current'].'</td>
                        <td>
                            <form method="GET">
                                <button><a href="admin_edit_defi.php?id='.$row['defi_id'].'" class="action_edit">Modifier</a></button>';

                                if($row["defi_verified"] == 1){
                                    echo'<button type="submit" name="defi_verified_true" value="'.$row['defi_id'].'" class="action_suspend_true">Dévalider</button>';
    
                                }else{
                                    echo'<button type="submit" name="defi_verified" value="'.$row['defi_id'].'" class="action_suspend">Valider</button>';
                                }

                                if($row["defi_current"] == 1){
                                    echo'<button type="submit" name="defi_current_true" value="'.$row['defi_id'].'" class="action_suspend_true">Actuel</button>';
    
                                }else{
                                    echo'<button type="submit" name="defi_current" value="'.$row['defi_id'].'" class="action_suspend">Pas actuel</button>';
                                }
    
                                echo'
                                <button type="submit" name="defi_delete" value="'.$row['defi_id'].'" class="action_delete">Supprimer</button>
                            </form>
                    </td>
                    </tr>
                    ';

        }
                   

                    ?>
            </tbody>
        </table>
    </main>

    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>