<?php 
    include('config.php');
    include('vimeo_setup.php');
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film DATA</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/fil_actu.css">
    <!-- <link rel="stylesheet" href="../css/fil_actu2.css"> -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" defer>
    </script>
    <script src="../js/app2.js" defer></script>
    <script src="../js/functions.js" defer></script>
    <script src="../js/fil_actu.js" defer></script>
</head>

<body style="min-height: 100vh">
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        consoleWarn('No ID specified in GET parameters.');
        consoleWarn('$id have been automatically set to 1.');
        $id = 1;
    }

    $query = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM videos, defis, users WHERE video_user_id=user_id AND defi_id=video_defi_id  AND video_id = $id";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($rows as $row) {
        echo "
        <div class='film_container' title='{$row["video_id"]}'>
        <div class='fb_c'>
            <div class='film_header'>
    
            
              <div class='film_settings'>";
            
            if (func::checkLoginState($db)) { # If the user is connected
                echo"  
                    <div class='film_settings_icon' onclick='filmSettings()'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>";
        }
        // Enregistrer un film
        
        if (func::checkLoginState($db)) { # If the user is connected

                        $query10 = "SELECT COUNT(*) as nbr FROM saved WHERE saved_user_id={$_COOKIE['userid']} AND saved_video_id={$row['video_id']}";
                        $stmt10 = $db->prepare($query10);
                        $stmt10->execute();

                        $row10 = $stmt10->fetch(PDO::FETCH_ASSOC);

                        if ($row10['nbr'] >= 1) {
                            echo'<img src="sources/img/film_saved_icon_click.svg" class="film_saved_icon" alt="" onclick="saveFilm(this)" title="'.$row["video_id"].'">';
                        } else {
                            echo'<img src="sources/img/film_saved_icon.svg" class="film_saved_icon" alt="" onclick="saveFilm(this)" title="'.$row["video_id"].'">';
                        }

        } else { # If the user is an asshole
            echo "
                        <img src='sources/img/film_saved_icon.svg' class='film_saved_icon' alt='' onclick='popupConnexion()'>";
        }
    
        echo "
                    <div class='film_settings_container'>";
    
                    if($row['video_user_id'] == $_COOKIE['userid']){
                        echo "
                            <a class='delete_option' onclick='popupDeleteFilm()'>Supprimer</a>
                            <a>Archiver</a>
                            <a onclick='popupEditFilm()'>Modifier</a>
                        ";
                    } else {
                        echo"
                            <a href='".$url."?accueil=true&report_video=". $row["video_id"] . "&defi=".$row['video_defi_id']."'>Signaler</a>";

                    }
                        
                    echo"
                    </div>
                </div>
                <p class='film_title'>{$row["video_title"]}</p>
                <img src='sources/img/close_icon.svg' class='close_icon' alt='' onclick='closePopupFilm(this)'>
            </div>
    
            <!-- Film -->
            <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='film'></iframe>
    
    
    
            <div class='film_informations'>
    
                <div class='fb_jsb film_informations_header'>
                    <div class='fb_jsb'>
    
                        <!-- Challenge section -->
                        <div class='fb challenge_container'>
                            <div class='defi_icon challenge_defi_icon'></div>
                            <a href='defi_details.php?defi={$row["defi_id"]}' class='challenge_title'>{$row["defi_name"]}</a>
                        </div>
    
                        <!-- Date + duration section -->
                        <p class='film_time'>{$row["time"]}</p>
                        <p class='film_date'>".date('d/m/Y', strtotime($row["video_date"]))."</p>
                    </div>";
    
        if (func::checkLoginState($db)) { # If the user is connected
            echo "<div class='fb_jsb'>
    
                        <!-- Like section -->
                        <div class='fb_jsb like_container'>";

                        // <!-- Pop corn image -->

                        $query10 = "SELECT COUNT(*) as nbr FROM liked WHERE liked_user_id={$_COOKIE['userid']} AND liked_video_id={$row['video_id']}";
                        $stmt10 = $db->prepare($query10);
                        $stmt10->execute();

                        $row10 = $stmt10->fetch(PDO::FETCH_ASSOC);

                        if ($row10['nbr'] >= 1) {
                            echo"
                            <img src='sources/img/pop_corn.png' class='pop_corn_icon' onclick='addLike(this)'>";
                        } else {
                            echo"
                            <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='addLike(this)'>";
                        }

                        echo"
                            <p class='film_pop_corn_number pop_corn_number'>" . $row['video_like_number'] . " J'aime</p>
                        </div>
    
                        <!-- Share section -->
                        <div class='fb_jsb share_container' title=".$row['video_id']." onclick='popupShare(this)'>
                            <div class='share_icon'></div>
                            <p class='share_title'>Partager</p>
                        </div>
                    </div>";
        } else { # If the user is an asshole
            echo "<div class='fb_jsb'>
    
                        <!-- Like section -->
                        <div class='fb_jsb' onclick='popupConnexion()'>
                            <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon'>
                            <p class='film_pop_corn_number'>" . $row['video_like_number'] . " J'aime</p>
                        </div>
    
                        <!-- Share section -->
                        <div class='fb_jsb share_container' onclick='popupConnexion()'>
                            <div class='share_icon'></div>
                            <p class='share_title'>Partager</p>
                        </div>
                    </div>";
        }
    
        echo "
                </div>
    
                <p class='film_description'>".nl2br($row["video_synopsis"])."</p>
    
                <div class='fb_jsa genre_distribution_container'>
                    <p class='genre_container'><span>Genres</span> <br> {$row["video_genre"]}</p>
                    <p class='distribution_container'><span>Distribution</span> <br>";
                    echo '<a href="profil.php?id='.$row['user_id'].'">@'.$row['user_username'].'</a> &emsp;&emsp;';
                    
                    $query2 = "SELECT * FROM videos, users, `distribution` WHERE distribution_user_id=user_id AND distribution_video_id = '{$row['video_url']}' AND video_id = '{$row['video_id']}'";
                    $stmt2 = $db->prepare($query2);
                    $stmt2->execute();
    
                    $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
                    foreach ($rows2 as $row2) {
    
                        echo '<a href="profil.php?id='.$row2['user_id'].'">@'.$row2['user_username'].'</a> &emsp;&emsp;';
                    }
    
                    echo"
                </div>
    
            </div>
            <div class='fb_jc ai-c comment_title_container' onclick='popupFilmComment()'>
                <div class='comment_icon'></div>";
    
        $query = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id = $id";
        $stmt = $db->prepare($query);
        $stmt->execute();
    
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    
        echo "<p class='comment_title'>" . $rows['number'] . " commentaires</p>
                <div class='comment_arrow'></div>
            </div>
        </div>
        
        
        <!-- Comment -->
        <div class='comment_space_container' title='{$row["video_id"]}'>
        ";


    }

    // <!-- Write a comment -->

    if (func::checkLoginState($db)) { # If the user isn't connected

        $query2 = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
        $stmt2 = $db->prepare($query2);
        $stmt2->execute();

        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

        echo "
                    <form action='' method='POST'>
                        <div class='write_comment'>
                            <img src='database/profile_pictures/".$row2['user_profile_picture']."' alt='' class='pp_profile'>
                            <textarea class='comment_textarea' name='comment_content' placeholder='Écrire un commentaire...'></textarea>
                            <input type='submit' class='send_comment' name='comment_send' value='".$_GET['id']."'>
                        </div>
                    </form>

                    ";

    } else {

        echo "
                    <form>
                        <div class='write_comment'  onclick='popupConnexion()'>
                            <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'></div>
                            <textarea name='comment' class='comment_textarea' placeholder='Écrire un commentaire...'></textarea>
                            <input type='submit' class='send_comment' value=''>
                        </div>
                    </form>

                    ";
    }
?>
    <!-- All the comments -->
    <?php

    $query = "SELECT * FROM comments, users, videos WHERE comment_video_id=video_id AND user_id=comment_user_id AND video_id = $id ORDER BY comment_date DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {

        echo "
            <div class='comment_content'>
                <div class='fb_jsb position_r'>
                    <a href='profil.php?id={$row['user_id']}' class='fb'>
                    <img src='database/profile_pictures/".$row['user_profile_picture']."' alt='' class='pp_profile'>

                        <div class='fb_c_jsb pseudo_date_comment'>
                            <p class='pseudo'>{$row["user_username"]}</p>
                            <p class='comment_date'>" . date('d-m-Y', strtotime($row["comment_date"])) . "</p>
                        </div>
                    </a>
                    <div class='comment_param_container' onclick='commentFilmSettings($(this))'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>

                    <div class='comment_settings_container'>";

        if ($row["comment_user_id"] == $_COOKIE["userid"] || $row2['user_admin'] > 0) {
            echo "
                            <a href='".$url."?accueil=true&delete_comment=" . $row["comment_id"] . "&defi=".$_GET['defi']."'>Supprimer</a>";
        } else {
            echo "
                        <a href='".$url."?accueil=true&report_comment=". $row["comment_id"] . "&defi=".$row['video_defi_id']."'>Signaler</a>";
        }

        echo "
                    </div>
                </div>
    
                <p class='comment_text'>" . $row["comment_content"] . "</p>";
    

                if (func::checkLoginState($db)) { # If the user isn't connected

                    echo"
                <div class='fb_jsa ai-c'>
                    <div class='fb_jsb'  onclick='addLike(this)'>
                        <img class='pop_corn_icon' src='sources/img/pop_corn_icon.svg' alt=''>
                        <p class='pop_corn_number'>0 J'aime</p>
                    </div>
                    <div class='fb_jsb comment_container'  onclick=''>
                        <div class='comment_icon'></div>
                        <p class='comment_number'><nobr>0 réponses</nobr></p>
                    </div>
                    <div class='fb_jsb share_container' onclick=''>
                        <div class='share_icon'></div>
                        <p class='share_title'>Partager</p>
                    </div>
                </div>";

                } else {
                    echo"
                    <div class='fb_jsa ai-c'>
                        <div class='fb_jsb'  onclick='popupConnexion()'>
                            <img class='pop_corn_icon' src='sources/img/pop_corn_icon.svg' alt=''>
                            <p class='pop_corn_number'>0 J'aime</p>
                        </div>
                        <div class='fb_jsb comment_container'  onclick='popupConnexion()'>
                            <div class='comment_icon'></div>
                            <p class='comment_number'><nobr>0 réponses</nobr></p>
                        </div>
                        <div class='fb_jsb share_container' onclick='popupConnexion()'>
                            <div class='share_icon'></div>
                            <p class='share_title'>Partager</p>
                        </div>
                    </div>";
                }

                echo"
            </div>";
    }

?>
    </div>
    </div>
    <!-- Delete warning -->
    <div class='pop_up_container delete_warning'>
        <div class='pop_up_header'>
            <h2>Supprimer</h2>
            <img src='sources/img/close_icon.svg' class='delete_close_icon' alt='' onclick='closePopupDeleteFilm()'>
        </div>
        <p class='pop_up_text'>Es-tu sûr de vouloir supprimer ton court-métrage <?php echo $row['video_title']?> ?</p>
        <form action="" method='POST'>
            <button type="submit" name="video_delete" value="<?php echo $id ?>"
                class='btn pop_up_btn delete_btn'>Supprimer</button>
        </form>
        <!-- <a href="<?php echo $url."?video_delete=".$id?>" class='btn pop_up_btn delete_btn'>Supprimer</a> -->
    </div>


    <!-- Modify film -->
    <div class="pop_up_container modify_film_container">
        <form action="" method="post" enctype='multipart/form-data'>
            <!-- Close icon -->
            <div class="pop_up_header">
                <h2>Modifier les informations</h2>
                <img src='sources/img/close_icon.svg' class='modify_close_icon' alt='' onclick='closePopupEditFilm()'>

            </div>

            <div class="modify_film_input_container">
                <div class="input_container">
                    <label for="title">
                        <span>Titre</span>
                        <input type="text" class="input_connexion" id="title" name="title"
                            value="<?php echo $row['video_title']; ?>" required>
                    </label>
                </div>
                <div class="input_container">
                    <label for="synopsis">
                        <span>Synopsis</span>
                        <textarea class="input_connexion input_synopsis" id="synopsis" name="synopsis" cols="30"
                            rows="6" required><?php echo $row['video_synopsis']; ?></textarea>
                    </label>
                </div>

                
                <!-- Input poster -->
                <div class="modify_file_banner btn">
                    <button class="btn modify_btn_banner">Modifier le poster</button>
                    <input type="file" accept=".png,.jpeg,.jpg" class="" name="poster">
                </div>

                <button type="submit" class="btn modify_film_btn" name="modify_film_btn" value="<?php echo $row['video_id']; ?>">Modifier</button>
            </div>
        </form>
    </div>
</body>

</html>