<?php
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
    include('assets/php/config.php');
    require("ressources/pop_up_film_information.php");
?>

<?php
    if(!func::checkLoginState($db)){ # If the user isn't connected
        redirect('login.php');
    } else {
        if(isset($_GET['id']) && !isset($_GET['id']) == $_COOKIE['userid']){
            $query = "SELECT * FROM users WHERE user_id = ".$_GET['id'].";";
            $stmt = $db->prepare($query);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
        $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}




if(isset($_GET["modify_btn"]) && isset($_GET["username"])){

    $id = $_COOKIE['userid'];
    $username = addslashes($_GET['username']);
      $profile_picture = $_GET['profile_picture'];
      $banner = $_GET['banner'];
      $name = addslashes($_GET['name']);
      $website = $_GET['website'];
      $bio = addslashes($_GET['bio']);

    if(isset($_GET["profile_picture"]) && isset($_GET["banner"])){
        $sql = "UPDATE users SET user_username='$username', user_profile_picture='$profile_picture', user_banner='$banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
      }

    else if(isset($_GET["profile_picture"])){
        $sql = "UPDATE users SET user_username='$username', user_profile_picture='$profile_picture', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    }

    else if(isset($_GET["banner"])){
        $sql = "UPDATE users SET user_username='$username', user_banner='$banner', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";
    }

    else {
        $sql = "UPDATE users SET user_username='$username', user_name='$name', user_website='$website', user_bio='$bio' WHERE user_id='$id'";

    }

    $stmt = $db->prepare($sql);

    $stmt->execute();

    header('Location: profil.php?success=true');
}


// S'abonner 


if (isset($_GET["add_subscription"])){
    $sql = "INSERT INTO subscription (subscription_subscriber_id, subscription_artist_id) VALUES (:subscriber_id, :artist_id)";

    $attributes = array(
      'subscriber_id' => $_GET['add_subscription'],
      'artist_id' => $_GET['id'],
    );

    $stmt = $db->prepare($sql);

    $stmt->execute($attributes);

    $db = null;

    header('Refresh:0; url=profil.php?id='.$_GET['id']);
}

// Se désabonner 


if (isset($_GET["delete_subscription"])){
    $subscriber_id = $_GET['delete_subscription'];
    $artist_id = $_GET["id"];
    $sql = "DELETE FROM subscription WHERE subscription_subscriber_id='$subscriber_id' AND subscription_artist_id='$artist_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $db = null;

    header('Refresh:0; url=profil.php?id='.$_GET['id']);

}

// Supprimer un utilisateur de ses abonnés

if (isset($_GET["delete_subscriber"])){
    $subscriber_id = $_GET['delete_subscriber'];
    $artist_id = $_COOKIE['userid'];
    $sql = "DELETE FROM subscription WHERE subscription_subscriber_id='$subscriber_id' AND subscription_artist_id='$artist_id'";

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $db = null;

    header('Refresh:0; url=profil.php?id='.$_GET['id']);

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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/fullpage.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/functions.js" defer></script>
</head>

<body>

    <?php
    if (isset($_GET['success'])) {
        echo'
        <p class="message_true_container">
                Ton profil a bien été modifié !
        </p>';
    }
    ?>
    <main class="main_content">

        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a href="fil_actu.php" class="reah_logo"></a>

            <!-- Search bar -->
            <form action="" class="form_search_bar">
                <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
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
                    <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover'  class='menu_pp' onclick='toggleBurgerMenu()'></div>
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

                if(isset($_GET['id'])){
                    $query = "SELECT * FROM users WHERE user_id = ".$_GET['id'].";";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }

                    echo"<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_banner']) .") no-repeat center/cover' alt=''  class='banner'></div>";
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
                            
                            if(isset($_GET['id']) && isset($_GET['id']) == $_COOKIE['userid']){ #if the profile is an other user's profile

                            $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=".$_GET['id'].";";
                            $stmt2 = $db->prepare($query2);
                            $stmt2->execute();
                    
                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                            echo $row2['subscriber_nb'];

                            } else {
                                $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=".$_COOKIE['userid'].";";
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
                            
                            if(isset($_GET['id']) && !isset($_GET['id']) == $_COOKIE['userid']){ #if the profile is an other user's profile

                            $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=".$_GET['id'].";";
                            $stmt2 = $db->prepare($query2);
                            $stmt2->execute();
                    
                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                            echo $row2['subscription_nb'];

                            } else {
                                $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=".$_COOKIE['userid'].";";
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
                    if(isset($_GET['id']) && !isset($_GET['id']) == $_COOKIE['userid']){ #if the profile is an other user's profile
                        $query = "SELECT * FROM users, subscription WHERE user_id = ".$_GET['id']." AND subscription_subscriber_id=".$_COOKIE['userid'].";";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach($rows as $row){}

                        if($row['subscription_artist_id'] == $_GET['id']){
                            echo'
                            <div class="btn subscribe_btn subscribe_btn_click" onclick="subscribe()">Se désabonner</div>';

                        } else {
                            echo'
                                    <a href="profil.php?id='.$_GET['id'].'&add_subscription='.$_COOKIE["userid"].'" class="btn subscribe_btn" onclick="subscribe()">S\'abonner</a>';
                        }
                    }
                    ?>
                </div>


                <!-- Profile photo + username -->
                <?php
                // Si on visite le profil d'un utilisateur

                    echo"<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover' alt=''  class='profile_photo'></div>";
                ?>
            </div>

            <div class="fb_jsb profile_content2">
                <div class="fb profile_bio_container">
                    <?php
                        echo '<p class="profile_username">'.$row['user_username'].'</p>';
                    ?>
                    <div class="red_line profile_line"></div>
                    <?php 
                        echo '<p class="profile_name">'.$row['user_name'].'</p>';
                    ?>
                    <?php 
                        echo '<p class="profile_bio">'.$row['user_bio'].'</p>';
                    ?>
                    <?php 
                        echo '<a target="_blank" href="https://'.$row['user_website'].'" class="profile_website">'.$row['user_website'].'</a>';
                    ?>
                </div>

                <!-- Modify icon -->

                <?php
                    if(isset($_GET['id']) && !isset($_GET['id']) == $_COOKIE['userid']){ #if the profile is an other user's profile
                        $query = "SELECT * FROM users WHERE user_id = ".$_GET['id'].";";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo"
                        <div class='user_settings'>
                        <div class='user_settings_icon' onclick='userSettings()'>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>";
        
                        echo"
                        <div class='user_settings_container'>
                            <div>Signaler</div>
                            <div>Bloquer</div>
                        </div>
                    </div>";
                    
                    } else {
                        echo'
                        <img src="sources/img/modify_icon.svg" class="modify_icon" alt="">';
                    }
                    ?>
                <div class="fb_c">
                </div>
            </div>
        </div>

        <!-- Realisations's number -->

        <div class="fb_jc realisation_number_container">
            <div class="fb_jsb realisation_number_content">
                <p class="realisation_number_content_title realisation_number_content_title1" number="2"><span
                        class="realisation_number_content_number ">20</span> réalisations </p>
                <p class="realisation_number_content_title realisation_number_content_title2" number="1"><span
                        class="realisation_number_content_number">80</span> identifiés </p>
                <div class="red_line realisation_number_content_line"></div>
            </div>
        </div>


        <!-- All realisations -->
        <div class="all_realisation_container">

            <!-- Realisations's videos -->
            <div class="realisation_container">

                <?php
                // $requete="SELECT title,username,url,DATE_FORMAT(duration, '%imin %s' ) AS duration,synopsis,poster,photo FROM re_films, re_users, re_a_realise WHERE id_films=realise_ext_films AND id_users=realise_ext_users";
                // $stmt=$db->query($requete);
                // $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                // foreach($resultat as $films){
                    echo "

                <!-- Video container -->
                <div class='video_container'>

                    <!-- Short film -->
                    <div class='video_content'>
                        <video class='video' poster='{$films["poster"]}' muted>
                            <source src='{$films["url"]}' type='video/mp4'>
                        </video>

                        <!-- Time -->
                        <p class='time'>{$films["duration"]}</p>
                    </div>

                    <!-- Short film\'s informations -->
                    <div class='description_container'>
                        <div class='reaction_container'>
                            <div class='fb_jsb'>

                                <!-- Pop corn image -->
                                <img class='pop_corn_icon' src='sources/img/pop_corn.png' alt=''>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>".$row['video_like_number']." J'aime</p>
                            </div>

                            <!-- Comment icon -->
                            <div class='fb_jc ai-c'>
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='fb_jsb share_container'>
                                <div class='share_icon'></div>
                                <p class='share_title'>Partager</p>
                            </div>
                        </div>

                        <div class='fb_c_jsb'>
                            <div class='synopsis_title_container' >
                                <h3 class='synopsis_title'>{$films["title"]}</h3>
                                <p class='see_more'>Voir plus
                                <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                </p>
                            </div>
                    
                        <p>{$films["synopsis"]}</p>


                        </div>
                    </div>


                </div>

                ";
                // }

                ?>
            </div>

            <!-- Identified's videos -->
            <div class="identified_container">

                <?php
                // $requete="SELECT title,username,url,DATE_FORMAT(duration, '%imin %s' ) AS duration,synopsis,poster,photo FROM re_films, re_users, re_a_realise WHERE id_films=realise_ext_films AND id_users=realise_ext_users";
                // $stmt=$db->query($requete);
                // $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                // foreach($resultat as $films){
                echo "

                <!-- Video container -->
                <div class='video_container'>

                    <!-- Short film -->
                    <div class='video_content'>
                        <video class='video' poster='{$films["poster"]}' muted>
                            <source src='{$films["url"]}' type='video/mp4'>
                        </video>

                        <!-- Name + pp -->
                        <div class='user_container'>
                            <img src='{$films["photo"]}' class='pp_profile' alt=''>
                            <p class='pseudo'>{$films["username"]}</p>
                            <div class='flou'></div>
                        </div>

                        <!-- Time -->
                        <p class='time'>{$films["duration"]}</p>
                    </div>

                    <!-- Short film\'s informations -->
                    <div class='description_container'>
                        <div class='reaction_container'>
                            <div class='fb_jsb'>

                                <!-- Pop corn image -->
                                <img class='pop_corn_icon' src='sources/img/pop_corn.png' alt=''>
                                <!-- Like\'s number -->
                                <p class='pop_corn_number'>515 J'aime</p>
                            </div>

                            <!-- Comment icon -->
                            <div class='fb_jc ai-c'>
                                <div class='comment_icon'></div>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='fb_jsb share_container'>
                                <div class='share_icon'></div>
                                <p class='share_title'>Partager</p>
                            </div>
                        </div>

                        <div class='fb_c_jsb'>
                            <div class='synopsis_title_container' >
                                <h3 class='synopsis_title'>{$films["title"]}</h3>
                                <p class='see_more'>Voir plus
                                <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                </p>
                            </div>
                    
                        <p>{$films["synopsis"]}</p>


                        </div>
                    </div>


                </div>

                ";
                // }
                ?>
            </div>
        </div>
    </main>

    <!-- Modify btn -->
    <div class="pop_up_container modify_container">
        <form action="profil.php" method="get">
            <!-- Close icon -->
            <img src='sources/img/close_icon.svg' class='modify_close_icon' alt=''>

            <!-- Banner -->
            <?php
                    echo"<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_banner']) .") no-repeat center/100%' alt=''  class='modify_banner'></div>";
                ?>

            <div class="modify_profile_photo_container">
                <!-- Profile photo -->
                <?php
                    echo"<div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover' alt=''  class='modify_profile_photo'></div>";
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
                        <input type="text" class="input_connexion" id="username" name="username"
                            value="<?php echo $row['user_username'];?>" required>
                    </label>
                </div>
                <div class="input_container">
                    <label for="name">
                        <span>Nom</span>
                        <input type="text" class="input_connexion" id="name" name="name"
                            value="<?php echo $row['user_name'];?>">
                    </label>
                </div>
                <div class="input_container">
                    <label for="website">
                        <span>Site web</span>
                        <input type="text" class="input_connexion" id="website" name="website"
                            value="<?php echo $row['user_website'];?>">
                    </label>
                </div>
                <div class="input_container">
                    <label for="bio">
                        <span>Bio</span>
                        <textarea class="input_connexion input_bio" id="bio" name="bio" cols="30"
                            rows="6"><?php echo $row['user_bio'];?></textarea>
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
            <h2><?php echo $row['user_username'];?></h2>
            <!-- Close icon -->
            <img src='sources/img/close_icon.svg' class='close_icon' alt=''>
        </div>

        <!-- Title -->
        <div class="subsciption_title_container">
            <div class="subscription_title1 subscriber_title" number="2"><span
                    class="realisation_number_content_number ">

                    <!-- Nombre d'abonnés -->
                    <?php
                            
                            if(isset($_GET['id'])){ #if the profile is an other user's profile

                            $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=".$_GET['id'].";";
                            $stmt2 = $db->prepare($query2);
                            $stmt2->execute();
                    
                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                            echo $row2['subscriber_nb'];

                            } else {
                                $query2 = "SELECT COUNT(subscription_subscriber_id) as subscriber_nb FROM subscription WHERE subscription_artist_id=".$_COOKIE['userid'].";";
                                $stmt2 = $db->prepare($query2);
                                $stmt2->execute();
                        
                                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    
                                echo $row2['subscriber_nb'];
                            } 
                            ?>



                </span> Abonnés</div>
            <div class="subscription_title2 subscription_title" number="1"><span
                    class="realisation_number_content_number ">

                    <!-- Nbr d'abonnements -->

                    <?php
                            
                            if(isset($_GET['id'])){ #if the profile is an other user's profile

                            $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=".$_GET['id'].";";
                            $stmt2 = $db->prepare($query2);
                            $stmt2->execute();
                    
                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                            echo $row2['subscription_nb'];

                            } else {
                                $query2 = "SELECT COUNT(subscription_artist_id) as subscription_nb FROM subscription WHERE subscription_subscriber_id=".$_COOKIE['userid'].";";
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
                            
                            if(isset($_GET['id'])){ #if the profile is an other user's profile

                            $query = "SELECT * FROM users, subscription WHERE subscription_artist_id=".$_GET['id']." AND subscription_subscriber_id=user_id ;";
                            $stmt = $db->prepare($query);
                            $stmt->execute();
                    
                            $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

                            foreach($rows as $row){

                                echo'
                                <div class="subscription_user">
                                <a href="profil.php?id='.$row['user_id'].'" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) .') no-repeat center/cover"></a>
                                        <a href="profil.php?id='.$row['user_id'].'" class="subscription_username_container">
                                            <div class="subscription_username">'.$row['user_username'].'</div>
                                            <div class="subscription_name">'.$row['user_name'].'</div>
                                        </a>
                                    <div class="btn subscriber_user_btn" onclick="deleteSubscriber()">Supprimer</div>
                                </div>';

                            }

                            } else {
                                $query = "SELECT * FROM users, subscription WHERE subscription_artist_id=".$_COOKIE['userid']." AND subscription_subscriber_id=user_id;";
                                $stmt = $db->prepare($query);
                                $stmt->execute();
                        
                                $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
    
                                foreach($rows as $row){
                                    echo'
                                    <div class="subscription_user">
                                    <a href="profil.php?id='.$row['user_id'].'" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) .') no-repeat center/cover"></a>
                                            <a href="profil.php?id='.$row['user_id'].'" class="subscription_username_container">
                                                <div class="subscription_username">'.$row['user_username'].'</div>
                                                <div class="subscription_name">'.$row['user_name'].'</div>
                                            </a>
                                        <div class="btn subscriber_user_btn" onclick="deleteSubscriber()">Supprimer</div>
                                    </div>';
                                }
                            } 
                            ?>
                
            </div>

            <!-- All subscriptions -->
            <div class="subscription_section">

                <!-- User -->
                 
                <?php
                            
                            if(isset($_GET['id'])){ #if the profile is an other user's profile

                            $query = "SELECT * FROM users, subscription WHERE subscription_subscriber_id=".$_GET['id']." AND subscription_artist_id=user_id;";
                            $stmt = $db->prepare($query);
                            $stmt->execute();
                    
                            $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

                            foreach($rows as $row){
                                
                                echo'
                                <div class="subscription_user">
                                    <a href="profil.php?id='.$row['user_id'].'" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) .') no-repeat center/cover"></a>
                                        <a href="profil.php?id='.$row['user_id'].'" class="subscription_username_container">
                                            <div class="subscription_username">'.$row['user_username'].'</div>
                                            <div class="subscription_name">'.$row['user_name'].'</div>
                                        </a>

                                    <div class="btn subscriber_user_btn subscribe_btn_click" onclick="subscribe()">Abonné(e)</div>
                                </div>';

                            }

                            } else {
                                $query = "SELECT * FROM users, subscription WHERE subscription_subscriber_id=".$_COOKIE['userid']." AND subscription_artist_id=user_id;";
                                $stmt = $db->prepare($query);
                                $stmt->execute();
                        
                                $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
    
                                foreach($rows as $row){
                                    
                                echo'
                                <div class="subscription_user">
                                <a href="profil.php?id='.$row['user_id'].'" class="subscription_pp" style="background: url(data:image/jpg;base64,' . base64_encode($row['user_profile_picture']) .') no-repeat center/cover"></a>
                                        <a href="profil.php?id='.$row['user_id'].'" class="subscription_username_container">
                                            <div class="subscription_username">'.$row['user_username'].'</div>
                                            <div class="subscription_name">'.$row['user_name'].'</div>
                                        </a>
                                    <a class="btn subscriber_user_btn subscribe_btn_click" onclick="subscribe()">Abonné(e)</a>
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
        <p class="pop_up_text">Se désabonner de <?php echo $row['user_username']; ?> ?</p>
        <!-- <div class="btn pop_up_btn unfollow_btn">Se désabonner</div> -->
        <?php

        $user_id = $row['user_id'];
        if(isset($_GET['id'])){ #SI on se désabonne depuis le profil de l'utilisateur
            echo'<a href="profil.php?id='.$_GET['id'].'&delete_subscription='.$_COOKIE['userid'].'" class="btn pop_up_btn unfollow_btn">Se désabonner</a>';
        } else { #si on se désabonne depuis notre profil
            echo'<a href="profil.php?id='.$user_id.'&delete_subscription='.$_COOKIE['userid'].'" class="btn pop_up_btn unfollow_btn">Se désabonner</a>';
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

        echo'<a href="profil.php?id='.$_GET['id'].'&delete_subscriber='.$row['user_id'].'" class="btn pop_up_btn unfollow_btn">Supprimer</a>';

        ?>
    </div>

    <script src="assets/js/profil.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
    <!-- <script src="assets/js/fil_actu.js"></script> -->
</body>

</html>