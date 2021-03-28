<?php
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
include('assets/php/config.php');
// include("ressources/pop_up_film_information.php");
include("ressources/pop_up_connexion.php");
include("ressources/pop_up_share.php");
include('assets/php/comments.php');


// Ajout d'un commentaire
if (isset($_GET['comment_send'])) {

    $query = "SELECT * FROM videos, comments WHERE comment_id = " . $_GET['comment_send'] . " AND comment_video_id = video_id;";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sql = "INSERT INTO comments (comment_content, comment_video_id, comment_user_id) VALUES (:content, :video_id, :user_id)";
    
    $attributes = array(
        'content' => addslashes($_GET["comment_content"]),
        'video_id' => $_GET['comment_send'],
        'user_id' => $_COOKIE['userid'],
    );
    
    $stmt = $db->prepare($sql);
    
    $stmt->execute($attributes);
    
// echo $url; 

    // header('Location: defi_details.php?defi='.$row['video_defi_id']);
}


// Supression d'un commentaire
if (isset($_GET['delete_comment'])) {

    $query = "SELECT * FROM videos, comments WHERE comment_id = " . $_GET['delete_comment'] . " AND comment_video_id = video_id;";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $comment_id = $_GET['delete_comment'];
    $user_id = $_COOKIE['userid'];
    $sql = "DELETE FROM comments WHERE comment_user_id='$user_id' AND comment_id='$comment_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();

    // header('Location: defi_details.php?defi='.$row['video_defi_id']);

}


if (!func::checkLoginState($db)) { # If the user isn't connected
    // redirect('login.php');
} else {
    if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) {
        $query = "SELECT * FROM users WHERE user_id = " . $_GET['id'] . ";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $query = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}




if (isset($_GET["modify_btn"]) && isset($_GET["username"])) {

    $id = $_COOKIE['userid'];
    $username = addslashes($_GET['username']);
    $profile_picture = $_GET['profile_picture'];
    $banner = $_GET['banner'];
    $name = addslashes($_GET['name']);
    $website = $_GET['website'];
    $bio = addslashes($_GET['bio']);

    if (isset($_GET["profile_picture"]) && isset($_GET["banner"])) {
        $sql = "UPDATE users SET user_username='$username', user_profile_picture='$profile_picture', user_banner='$banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    } else if (isset($_GET["profile_picture"])) {
        $sql = "UPDATE users SET user_username='$username', user_profile_picture='$profile_picture', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    } else if (isset($_GET["banner"])) {
        $sql = "UPDATE users SET user_username='$username', user_banner='$banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    } else {
        $sql = "UPDATE users SET user_username='$username', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    }

    $stmt = $db->prepare($sql);

    $stmt->execute();

    header('Location: profil.php?success=true');
}


// S'abonner 


if (isset($_GET["add_subscription"])) {
    // header('Refresh:0; url=fil_actu.php?id=' . $_GET['id']);
    $sql = "INSERT INTO subscription (subscription_subscriber_id, subscription_artist_id) VALUES (:subscriber_id, :artist_id)";

    $attributes = array(
        'subscriber_id' => $_GET['add_subscription'],
        'artist_id' => $_GET['id'],
    );

    $stmt = $db->prepare($sql);

    $stmt->execute($attributes);

    // header('Location: defis.php?success=true');

    // redirect('fil_actu.php?id=' . $_GET['id']);
}

// Se désabonner 


if (isset($_GET["delete_subscription"])) {
    $subscription_id = $_GET['delete_subscription'];
    $subscriber_id = $_GET['delete_subscriber'];
    // $artist_id = $_GET["id"];
    $sql = "DELETE FROM subscription WHERE subscription_subscriber_id='$subscriber_id' AND subscription_artist_id='$subscription_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();


    // header('Refresh:0; url=profil.php?id=1');
}

// Supprimer un utilisateur de ses abonnés

if (isset($_GET["delete_subscriber"])) {
    $subscriber_id = $_GET['delete_subscriber'];
    $artist_id = $_COOKIE['userid'];
    $sql = "DELETE FROM subscription WHERE subscription_subscriber_id='$subscriber_id' AND subscription_artist_id='$artist_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();

    
    header('Refresh:0; url=profil.php?id=' . $_GET['id']);
}

// Signalement d'un utilisateur
if (isset($_GET['report_user'])) {

    $message_true = 'Ton signalement a bien été pris en compte.';

    $user_report_id = $_GET['report_user'];
    $user_id = $_COOKIE['userid'];

    $query = "SELECT * FROM users WHERE user_id= $user_report_id";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $report_user_id = $row["user_report_id"].','.$user_id;

    $sql = "UPDATE users SET user_report_id='$report_user_id' WHERE user_id='$user_report_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();

    // header('Location: fil_actu.php?accueil=true');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Profil</title>
    <link rel="stylesheet" href="assets/css/dark_mode.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/fullpage.css" />
    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <script src="assets/js/functions.js" defer></script>
</head>

<body>

    <?php
    if (isset($_GET['success'])) {
        echo '
        <p class="message_true_container">
                Ton profil a bien été modifié !
        </p>';
    }
    ?>
    <main class="main_content">

      <!-- Signalement -->
  <?php
    if (isset($message_true)) {
        echo '
        <p class="message_true_container">
                '.$message_true.'
        </p>';
    }
    ?>

<div class='dark_filter' onclick="closePopupFilm(this)"></div>


        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a href="fil_actu.php" class="reah_logo"></a>

            <!-- Search bar -->
            <form action="search.php" method="GET" class="form_search_bar">
                    <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs..." oninput="searchEngine(this.value)">
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
                    <a href='defis.php' class='defi_icon'></a>
                    <!-- Profile photo -->
                    <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . ") no-repeat center/cover'  class='menu_pp' onclick='toggleBurgerMenu()'></div>
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


        <div class="banner_container">
            <div class="banner_flou_left"></div>
            <?php

            if (isset($_GET['id'])) {
                $query = "SELECT * FROM users WHERE user_id = " . $_GET['id'] . ";";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $query = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            echo "<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_banner']) . ") no-repeat center/cover' alt=''  class='banner'></div>";
            ?>
            <div class="banner_flou_right"></div>
        </div>

        <div class="profile_container">

            <div class="fb_jsa profile_content1">
                <!-- Subscription section -->
                <div class="fb_c ai-c">
                    <div class="fb_jsb profile_subscription_container">
                        <div class="profile_subscription_content" number="1">
                            <p class="fb profile_subscription_number">


                                <!-- Nbr d'abonnés -->
                                <?php

                                                    if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile

                                    $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=" . $_GET['id'] . ";";
                                    $stmt2 = $db->prepare($query2);
                                    $stmt2->execute();

                                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                                    echo $row2['subscriber_nb'];
                                } else {
                                    $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=" . $_COOKIE['userid'] . ";";
                                    $stmt2 = $db->prepare($query2);
                                    $stmt2->execute();

                                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                                    echo $row2['subscriber_nb'];
                                }
                                ?>

                            </p>
                            <div class="red_line profile_subscription_line"></div>
                            <p class="profile_subscription_title">Abonnés</p>
                        </div>

                        <div class="profile_subscription_content" number="2">
                            <p class="fb profile_subscription_number">


                                <!-- Nbr d'abonnements -->

                                <?php

                                                    if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile

                                    $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=" . $_GET['id'] . ";";
                                    $stmt2 = $db->prepare($query2);
                                    $stmt2->execute();

                                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                                    echo $row2['subscription_nb'];
                                } else {
                                    $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=" . $_COOKIE['userid'] . ";";
                                    $stmt2 = $db->prepare($query2);
                                    $stmt2->execute();

                                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                                    echo $row2['subscription_nb'];
                                }
                                ?>

                            </p>
                            <div class="red_line profile_subscription_line"></div>
                            <p class="profile_subscription_title">Abonnements</p>
                        </div>
                    </div>


                    <!-- Subscription btn -->
                    <?php
                    if (func::checkLoginState($db)) { # If the user is connected

                            if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile
                            $query5 = "SELECT user_username,COUNT(subscription_id) as nbr FROM users, subscription WHERE user_id = " . $_GET['id'] . " AND subscription_subscriber_id=" . $_COOKIE['userid'] ." AND subscription_artist_id = '{$_GET['id']}';";
                            $stmt5 = $db->prepare($query5);
                            $stmt5->execute();

                            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($rows5 as $row5) {
                                
                            }
                            if ($row5['nbr'] >= 1) {
                                echo '
                            <div class="btn subscribe_btn subscribe_btn_click" onclick="subscribe()">Se désabonner</div>';
                            } else {
                                echo '
                                    <a href="profil.php?id=' . $_GET['id'] . '&add_subscription=' . $_COOKIE["userid"] . '" class="btn subscribe_btn" onclick="subscribe()">S\'abonner</a>';
                            }
                        }
                    }
                    ?>
                </div>


                <!-- Profile photo + username -->
                <?php
                // Si on visite le profil d'un utilisateur

                echo "<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . ") no-repeat center/cover' alt=''  class='profile_photo'></div>";
                ?>
            </div>

            <div class="fb_jsb profile_content2">
                <div class="fb profile_bio_container">
                    <?php
                    echo '<p class="profile_username">' . $row['user_username'] . '</p>';
                    ?>
                    <div class="red_line profile_line"></div>
                    <?php
                    echo '<p class="profile_name">' . $row['user_name'] . '</p>';
                    ?>
                    <?php
                    echo '<p class="profile_bio">' . $row['user_bio'] . '</p>';
                    ?>
                    <?php
                    echo '<a target="_blank" href="https://' . $row['user_website'] . '" class="profile_website">' . $row['user_website'] . '</a>';
                    ?>
                </div>

                <!-- Modify icon -->

                <?php
                if (func::checkLoginState($db)) { # If the user is connected

                    if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile
                        $query = "SELECT * FROM users WHERE user_id = " . $_GET['id'] . ";";
                        $stmt = $db->prepare($query);
                        $stmt->execute();

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo "
                        <div class='user_settings'>
                        <div class='user_settings_icon' onclick='userSettings()'>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>";

                        echo "
                        <div class='user_settings_container'>
                            <a href='profil.php?id=".$_GET['id']."&report_user=". $_GET['id'] . "'>Signaler</a>
                            <a>Bloquer</a>
                        </div>
                    </div>";
                    
                    } else {
                        echo '
                        <img src="sources/img/modify_icon.svg" class="modify_icon" alt="">';
                    }
                }
                ?>
                <div class="fb_c">
                </div>
            </div>
        </div>

        <!-- Realisations's number -->

        <div class="fb_jc realisation_number_container">
            <div class="fb_jsb realisation_number_content">
                <p class="realisation_number_content_title realisation_number_content_title1" number="2"><span class="realisation_number_content_number ">

                        <!-- Realisation number -->
                        <?php
                                            if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile
                            $requete = "SELECT COUNT(video_id) as video_number FROM videos, users WHERE video_user_id = user_id AND user_id = {$_GET['id']}";
                            $stmt = $db->query($requete);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo $row['video_number'];
                        } else {
                            $requete = "SELECT COUNT(video_id) as video_number FROM videos, users WHERE video_user_id = user_id AND user_id = {$_COOKIE['userid']}";
                            $stmt = $db->query($requete);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo $row['video_number'];
                        }
                        ?>
                    </span> réalisations </p>
                <p class="realisation_number_content_title realisation_number_content_title2" number="1"><span class="realisation_number_content_number">

                        <!-- Identified number -->

                        <?php
                                            if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile
                            $requete = "SELECT COUNT(video_id) as video_number FROM videos, users, `distribution` WHERE video_user_id = user_id AND distribution_video_id = video_id AND distribution_user_id = {$_GET['id']}";
                            $stmt = $db->query($requete);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo $row['video_number'];
                        } else {
                            $requete = "SELECT COUNT(video_id) as video_number FROM videos, users, `distribution` WHERE video_user_id = user_id AND distribution_video_id = video_id AND distribution_user_id = {$_COOKIE['userid']}";
                            $stmt = $db->query($requete);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo $row['video_number'];
                        }

                        ?>

                    </span> identifiés </p>
                <div class="red_line realisation_number_content_line"></div>
            </div>
        </div>


        <!-- All realisations -->
        <div class="all_realisation_container">

            <!-- Realisations's videos -->
            <div class="realisation_container">

                <?php

                                    if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile
                    $requete = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM videos, users WHERE video_user_id = user_id AND user_id = {$_GET['id']} ORDER BY video_id DESC";
                    $stmt = $db->query($requete);
                    $resultat = $stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach ($resultat as $row) {
                        echo "
                        <!-- Video container -->
                        <div class='video_container'>
        
                            <!-- Short film -->
                            <div class='video_content'>
                                            <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
        
        
                                <!-- Time -->
                                <p class='time'>{$row["time"]}</p>
                            </div>
        
                            <!-- Short film\'s informations -->
                            <div class='description_container'>
                                <div class='reaction_container'>
                                <div class='fb_jsb like_container'>
                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='addLike(this)'>
                                <p class='film_pop_corn_number pop_corn_number'>" . $row['video_like_number'] . " J'aime</p>
                            </div>
        
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupComment(this)'>
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'>";

                        // Comment's number
                        $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        echo "
                                                <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                        echo "
                                    </div>
        
                                    <!-- Share icon -->
                                    <div class='fb_jsb share_container' onclick='popupShare(this)'>
                                        <div class='share_icon'></div>
                                        <p class='share_title'>Partager</p>
                                    </div>
                                </div>
        
                                <div class='fb_c_jsb'>
                                    <div class='synopsis_title_container' title=" . $row['video_id'] ." onclick='popupFilm(this)' >
                                        <h3 class='synopsis_title'>{$row["video_title"]}</h3>
                                        <p class='see_more'>Voir plus
                                        <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                    </div>
                            
                                <p>{$row["video_synopsis"]}</p>
        
        
                                </div>
                            </div>
        
        
                        </div>
        
                        ";
                    }
                } else {
                    $requete = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM videos, users WHERE video_user_id = user_id AND user_id = {$_COOKIE['userid']} ORDER BY video_id DESC";
                    $stmt = $db->query($requete);
                    $resultat = $stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach ($resultat as $row) {
                        echo "
                        <!-- Video container -->
                        <div class='video_container'>
        
                            <!-- Short film -->
                            <div class='video_content'>
                                            <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
        
        
                                <!-- Time -->
                                <p class='time'>{$row["time"]}</p>
                            </div>
        
                            <!-- Short film\'s informations -->
                            <div class='description_container'>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
        
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>" . $row['video_like_number'] . " J'aime</p>
                                    </div>
        
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupComment(this)'>
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'>";

                        // Comment's number
                        $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        echo "
                                                <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                        echo "
                                    </div>
        
                                    <!-- Share icon -->
                                    <div class='fb_jsb share_container' onclick='popupShare(this)'>
                                        <div class='share_icon'></div>
                                        <p class='share_title'>Partager</p>
                                    </div>
                                </div>
        
                                <div class='fb_c_jsb'>
                                    <div class='synopsis_title_container' title=" . $row['video_id'] ." onclick='popupFilm(this)' >
                                        <h3 class='synopsis_title'>{$row["video_title"]}</h3>
                                        <p class='see_more'>Voir plus
                                        <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                    </div>
                            
                                <p>{$row["video_synopsis"]}</p>
        
        
                                </div>
                            </div>
        
        
                        </div>
        
                        ";
                    }
                }



                $stmt = null;
                $query = null;
                $rows = null;
                ?>
            </div>

            <!-- Identified's videos -->
            <div class="identified_container">

                <?php

                                    if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #if the profile is an other user's profile
                    $requete = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM videos, users, `distribution` WHERE video_user_id = user_id AND distribution_video_id = video_id AND distribution_user_id = {$_GET['id']} ORDER BY video_id DESC";
                    $stmt = $db->query($requete);
                    $resultat = $stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach ($resultat as $row) {
                        echo "

                <!-- Video container -->
                <div class='video_container'>

                    <!-- Short film -->
                    <div class='video_content'>
                                    <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>


                        <!-- Name + pp -->
                        <a href='profil.php?id=" . $row['user_id'] . "' class='user_container'>

                <img src='data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . "' alt=''  class='pp_profile'>

                    <p class='pseudo'>" . $row['user_username'] . "</p>
                    <div class='flou'></div>
                </a>
                        <!-- Time -->
                        <p class='time'>{$row["time"]}</p>
                    </div>

                    <!-- Short film\'s informations -->
                    <div class='description_container'>
                        <div class='reaction_container'>
                            <div class='fb_jsb like_container'>

                                <!-- Pop corn image -->
                                <img class='pop_corn_icon' src='sources/img/pop_corn_icon.svg' alt=''  onclick='addLike(this)'>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>" . $row['video_like_number'] . "</p>
                            </div>

                            <!-- Comment icon -->
                            <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupComment(this)'>
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'>";

                        // Comment's number
                        $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        echo "
                                        <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                        echo "
                            </div>

                            <!-- Share icon -->
                            <div class='fb_jsb share_container' onclick='popupShare(this)'>
                                <div class='share_icon'></div>
                                <p class='share_title'>Partager</p>
                            </div>
                        </div>

                        <div class='fb_c_jsb'>
                            <div class='synopsis_title_container' title=" . $row['video_id'] ." onclick='popupFilm(this)' >
                                <h3 class='synopsis_title'>{$row["video_title"]}</h3>
                                <p class='see_more'>Voir plus
                                <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                </p>
                            </div>
                    
                        <p>{$row["video_synopsis"]}</p>


                        </div>
                    </div>


                </div>

                ";
                    }
                } else {
                    $requete = "SELECT *, DATE_FORMAT(video_duration, '%imin %ss' ) as time FROM videos, `users`, `distribution` WHERE video_user_id = user_id AND distribution_video_id = video_id AND distribution_user_id = {$_COOKIE['userid']} ORDER BY video_id DESC";
                    $stmt = $db->query($requete);
                    $resultat = $stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach ($resultat as $row) {
                        echo "

                    <!-- Video container -->
                    <div class='video_container'>
    
                        <!-- Short film -->
                        <div class='video_content'>
                                        <iframe src='https://player.vimeo.com/video/" . $row['video_url'] . "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen class='video'></iframe>
    
    
                            <!-- Name + pp -->
                            <a href='profil.php?id=" . $row['user_id'] . "' class='user_container'>

                            <img src='data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . "' alt=''  class='pp_profile'>
            
                                <p class='pseudo'>" . $row['user_username'] . "</p>
                                <div class='flou'></div>
                            </a>
    
                            <!-- Time -->
                            <p class='time'>{$row["time"]}</p>
                        </div>
    
                        <!-- Short film\'s informations -->
                        <div class='description_container'>
                            <div class='reaction_container'>
                                <div class='fb_jsb like_container'>
    
                                    <!-- Pop corn image -->
                                    <img class='pop_corn_icon' src='sources/img/pop_corn_icon.svg' alt='' onclick='addLike(this)'>
                                    <!-- Like\'s number -->
                                    <p class='pop_corn_number'>" . $row['video_like_number'] . " J'aime</p>
                                </div>
    
                                <!-- Comment icon -->
                                <div class='fb_jc ai-c' title=" . $row['video_id'] . " onclick='popupComment(this)'>
                                    <div class='comment_icon'></div>
                                    <p class='profile_comment_title'>";

                        // Comment's number
                        $query2 = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id AND video_id={$row['video_id']}";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        echo "
                                            <p class='profile_comment_title'><nobr>" . $row2['number'] . " commentaires</nobr></p>";

                        echo "
                                </div>
    
                                <!-- Share icon -->
                                <div class='fb_jsb share_container' onclick='popupShare(this)'>
                                    <div class='share_icon'></div>
                                    <p class='share_title'>Partager</p>
                                </div>
                            </div>
    
                            <div class='fb_c_jsb'>
                                <div class='synopsis_title_container' title=" . $row['video_id'] ." onclick='popupFilm(this)' >
                                    <h3 class='synopsis_title'>{$row["video_title"]}</h3>
                                    <p class='see_more'>Voir plus
                                    <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                    </p>
                                </div>
                        
                            <p>{$row["video_synopsis"]}</p>
    
    
                            </div>
                        </div>
    
    
                    </div>
    
                    ";
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <?php
if (!func::checkLoginState($db)) { # If the user isn't connected
    redirect('login.php');
} else {
    if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) {
        $query = "SELECT * FROM users WHERE user_id = " . $_GET['id'] . ";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $query = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>

    <!-- Modify btn -->
    <div class="pop_up_container modify_container">
        <form action="profil.php" method="get">
            <!-- Close icon -->
            <img src='sources/img/close_icon.svg' class='modify_close_icon' alt=''>

            <!-- Banner -->
            <?php
            echo "<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_banner']) . ") no-repeat center/100%' alt=''  class='modify_banner'></div>";
            ?>

            <div class="modify_profile_photo_container">
                <!-- Profile photo -->
                <?php
                echo "<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) . ") no-repeat center/cover' alt=''  class='modify_profile_photo'></div>";
                ?>

                <div class="modify_file_container">
                    <!-- Input banner -->
                    <div class="modify_file_banner btn">
                        <button class="btn modify_btn_banner">Modifier la bannière</button>
                        <input type="file" accept=".png,.jpeg,.jpg" class="" name="banner">
                    </div>
                    <!-- Input profile photo -->
                    <div class="modify_file_profile_photo btn">
                        <button class="btn modify_btn_profile_photo">Modifier la photo de profil</button>
                        <input type="file" accept=".png,.jpeg,.jpg" class="" name="profile_picture">
                    </div>

                </div>
            </div>
            <!-- Inputs username, name, bio.. -->
            <div class="modify_input_container">
                <div class="input_container">
                    <label for="username">
                        <span>Nom d'utilisateur</span>
                        <input type="text" class="input_connexion" id="username" name="username" value="<?php echo $row['user_username']; ?>" required>
                    </label>
                </div>
                <div class="input_container">
                    <label for="name">
                        <span>Nom</span>
                        <input type="text" class="input_connexion" id="name" name="name" value="<?php echo $row['user_name']; ?>">
                    </label>
                </div>
                <div class="input_container">
                    <label for="website">
                        <span>Site web</span>
                        <input type="text" class="input_connexion" id="website" name="website" value="<?php echo $row['user_website']; ?>">
                    </label>
                </div>
                <div class="input_container">
                    <label for="bio">
                        <span>Bio</span>
                        <textarea class="input_connexion input_bio" id="bio" name="bio" cols="30" rows="6"><?php echo $row['user_bio']; ?></textarea>
                    </label>
                </div>

                <input type="submit" class="btn modify_btn" name="modify_btn" value="Modifier">
            </div>
        </form>
    </div>

    <!-- Subscribers and subsciptions page -->
    <div class="pop_up_container subscription_container">
        <div class="pop_up_header subscription_header">
            <!-- Username -->
            <h2><?php echo $row['user_username']; ?></h2>
            <!-- Close icon -->
            <img src='sources/img/close_icon.svg' class='close_icon' alt=''>
        </div>

        <!-- Title -->
        <div class="subsciption_title_container">
            <div class="subscription_title1 subscriber_title" number="2"><span class="realisation_number_content_number ">

                    <!-- Nombre d'abonnés -->
                    <?php

                    if (isset($_GET['id'])) { #if the profile is an other user's profile

                        $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=" . $_GET['id'] . ";";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                        echo $row2['subscriber_nb'];
                    } else {
                        $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=" . $_COOKIE['userid'] . ";";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                        echo $row2['subscriber_nb'];
                    }
                    ?>



                </span> Abonnés</div>
            <div class="subscription_title2 subscription_title" number="1"><span class="realisation_number_content_number ">

                    <!-- Nbr d'abonnements -->

                    <?php

                    if (isset($_GET['id'])) { #if the profile is an other user's profile

                        $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=" . $_GET['id'] . ";";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                        echo $row2['subscription_nb'];
                    } else {
                        $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=" . $_COOKIE['userid'] . ";";
                        $stmt2 = $db->prepare($query2);
                        $stmt2->execute();

                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                        echo $row2['subscription_nb'];
                    }
                    ?>

                </span> Abonnements</div>
            <div class="red_line subscription_line"></div>
        </div>

        <div class="pop_up_text subscription_content">
            <!-- All subscribers -->
            <div class="subscriber_section">

                <!-- User -->

                <?php

                if (isset($_GET['id'])) { #if the profile is an other user's profile

                    $query = "SELECT * FROM users, subscription WHERE subscription_artist_id=" . $_GET['id'] . " AND subscription_subscriber_id=user_id ;";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {

                        echo '
                                <div class="subscription_user">
                                <div class="fb ai-c">
                                <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) . ') no-repeat center/cover"></a>
                                        <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_username_container">
                                            <div class="subscription_username">' . $row['user_username'] . '</div>
                                            <div class="subscription_name">' . $row['user_name'] . '</div>
                                        </a>
                                </div>';

                if ($_GET['id'] == $_COOKIE['userid']) { #if the profile is the user's profile

                    echo'
                    <a href="profil.php?id=' . $_GET['id'] . '&delete_subscriber=' . $row['user_id'] . '" class="btn subscriber_user_btn">Supprimer</a>';

                            }

                        echo'
                            </div>';
                        }
                } else {
                    $query = "SELECT * FROM users, subscription WHERE subscription_artist_id=" . $_COOKIE['userid'] . " AND subscription_subscriber_id=user_id;";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {
                        echo '
                                    <div class="subscription_user">
                                <div class="fb ai-c">
                                <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) . ') no-repeat center/cover"></a>
                                            <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_username_container">
                                                <div class="subscription_username">' . $row['user_username'] . '</div>
                                                <div class="subscription_name">' . $row['user_name'] . '</div>
                                            </a>
                                </div>
                    <a href="profil.php?delete_subscriber=' . $row['user_id'] . '" class="btn subscriber_user_btn">Supprimer</a>

                                    </div>';
                    }
                }
                ?>

            </div>

            <!-- All subscriptions -->
            <div class="subscription_section">

                <!-- User -->

                <?php

                if (isset($_GET['id'])) { #if the profile is an other user's profile

                    $query = "SELECT * FROM users, subscription WHERE subscription_subscriber_id=" . $_GET['id'] . " AND subscription_artist_id=user_id;";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {

                        echo '
                                <div class="subscription_user">
                                <div class="fb ai-c">
                                <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) . ') no-repeat center/cover"></a>
                                        <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_username_container">
                                            <div class="subscription_username">' . $row['user_username'] . '</div>
                                            <div class="subscription_name">' . $row['user_name'] . '</div>
                                        </a>
                                </div>';

                                if ($_GET['id'] == $_COOKIE['userid']) { #if the profile is an other user's profile

                                    echo '<a href="profil.php?id=' . $_GET['id'] . '&delete_subscription='.$row['user_id'].'&delete_subscriber=' . $_COOKIE['userid'] . '" class="btn subscriber_user_btn subscribe_btn_click">Abonné(e)</a>';
                         
        
                                            }
                
                                        echo'
                                            </div>';
                                        
                    }
                } else {
                    $query = "SELECT * FROM users, subscription WHERE subscription_subscriber_id=" . $_COOKIE['userid'] . " AND subscription_artist_id=user_id;";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {

                        echo '
                                <div class="subscription_user">
                                <div class="fb ai-c">
                                <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) . ') no-repeat center/cover"></a>
                                        <a href="profil.php?id=' . $row['user_id'] . '" class="subscription_username_container">
                                            <div class="subscription_username">' . $row['user_username'] . '</div>
                                            <div class="subscription_name">' . $row['user_name'] . '</div>
                                        </a>
                                </div>
                                <a href="profil.php?delete_subscription='.$row['user_id'].'&delete_subscriber=' . $_COOKIE['userid'] . '" class="btn subscriber_user_btn subscribe_btn_click">Abonné(e)</a>
                                </div>';
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <div class="unfollow_dark_filter"></div>

    <!-- Unfollow pop up-->
    <div class="pop_up_container unfollow_container">
        <div class="pop_up_header">
            <h2>Se désabonner</h2>
            <img src='sources/img/close_icon.svg' class='unfollow_close_icon' alt=''>
        </div>
        <p class="pop_up_text">Se désabonner de <?php echo $row5['user_username']; ?> ?</p>
        <!-- <div class="btn pop_up_btn unfollow_btn">Se désabonner</div> -->
        <?php

        $user_id = $row['user_id'];
        if (isset($_GET['id']) && $_GET['id'] != $_COOKIE['userid']) { #SI on se désabonne depuis le profil de l'utilisateur
            echo '<a href="profil.php?id=' . $_GET['id'] . '&delete_subscription='.$_GET['id'].'&delete_subscriber=' . $_COOKIE['userid'] . '" class="btn pop_up_btn unfollow_btn">Se désabonner</a>';
        } else { #si on se désabonne depuis notre profil
            echo '<a href="profil.php?id=' . $_GET['id'] . '&delete_subscription='.$row['user_id'].'&delete_subscriber=' . $_COOKIE['userid'] . '" class="btn pop_up_btn unfollow_btn">Se désabonner</a>';
        }

        ?>
    </div>


    <!-- Delete subscriber pop up-->
    <div class="pop_up_container delete_subscriber_container">
        <div class="pop_up_header">
            <h2>Supprimer un abonné</h2>
            <img src='sources/img/close_icon.svg' class='unfollow_close_icon' alt=''>
        </div>
        <p class="pop_up_text">Supprimer <?php echo $row['user_username']; ?> de vos abonnés ?</p>
        <!-- <div class="btn pop_up_btn unfollow_btn">Se désabonner</div> -->
        <?php

        echo '<a href="profil.php?id=' . $_GET['id'] . '&delete_subscriber=' . $row['user_id'] . '" class="btn pop_up_btn unfollow_btn">Supprimer</a>';

        ?>
    </div>

    <script src="assets/js/profil.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
    <!-- <script src="assets/js/fil_actu.js"></script> -->
</body>

</html>