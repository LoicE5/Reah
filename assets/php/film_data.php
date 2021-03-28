<?php 
    include('config.php');
    include('vimeo_setup.php');

//     if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
//     $url = "https"; 
//   else
//     $url = "http"; 
    
//   // Ajoutez // à l'URL.
//   $url .= "://"; 
    
//   // Ajoutez l'hôte (nom de domaine, ip) à l'URL.
//   $url .= $_SERVER['HTTP_HOST']; 
    
//   // Ajouter l'emplacement de la ressource demandée à l'URL
//   $url .= $_SERVER['REQUEST_URI']; 
      
//   // Afficher l'URL
//   echo $url; 

//   var_dump($_GET['defi']);
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" defer></script>
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
            echo '<img src="sources/img/film_saved_icon.svg" class="film_saved_icon" alt="" onclick="saveFilm($(this))">';
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
                            <a>Modifier</a>
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
                        <p class='film_date'>{$row["video_date"]}</p>
                    </div>";
    
        if (func::checkLoginState($db)) { # If the user is connected
            echo "<div class='fb_jsb'>
    
                        <!-- Like section -->
                        <div class='fb_jsb like_container'>
                            <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='addLike(this)'>
                            <p class='film_pop_corn_number pop_corn_number'>" . $row['video_like_number'] . " J'aime</p>
                        </div>
    
                        <!-- Share section -->
                        <div class='fb_jsb share_container' onclick='popupShare()'>
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
    
                <p class='film_description'>{$row["video_synopsis"]}</p>
    
                <div class='fb_jsa genre_distribution_container'>
                    <p class='genre_container'><span>Genres</span> <br> {$row["video_genre"]}</p>
                    <p class='distribution_container'><span>Distribution</span> <br>";
                    echo '<a href="profil.php?id='.$row['user_id'].'">@'.$row['user_username'].'</a> &emsp;&emsp;';
                    
                    $query2 = "SELECT * FROM videos, users, `distribution` WHERE distribution_user_id=user_id AND distribution_video_id = '{$row['video_id']}' AND video_id = '{$row['video_id']}'";
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

        $query = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "
                    <form action='' method='GET'>
                        <div class='write_comment'>
                            <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . ") no-repeat center/cover'  class='pp_profile'></div>
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
                        <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . ") no-repeat center/cover'  class='pp_profile'></div>
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

        if ($row["comment_user_id"] == $_COOKIE["userid"]) {
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
    <p class='pop_up_text'>Es-tu sûr de vouloir supprimer ton court-métrage Je t'haine ?</p>
    <div class='btn pop_up_btn delete_btn'>Supprimer</div>
</div>
</body>
</html>