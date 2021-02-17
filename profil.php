<?php
    include('assets/php/config.php');
    require("ressources/pop_up_film_information.php");
?>
<?php
    if(!func::checkLoginState($db)){ # If the user isn't connected
        redirect('login.php');
    } else {
        $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <main class="main_content">

        <!-- Navigation menu -->
        <nav class="menu_nav">

            <!-- Logo Réah -->
            <a class="reah_logo" href="fil_actu.php"> <img src="sources/img/logo_reah.svg" alt=""></a>

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
                    <a href='fil_actu.php'> <img src='sources/img/fil_actu_icon.svg' class='defi_icon' alt=''></a>
                    <!-- Defi icon -->
                    <a href='defis.php'> <img src='sources/img/defi_icon.svg' class='defi_icon' alt=''></a>
                    <!-- Profile photo -->
                    <img src='".$row['user_profile_picture']."' class='menu_pp' alt='' onclick='toggleBurgerMenu(this)'>
                    </div>
                    </nav>";

                } else {
                    redirect('login.php');
                }
            ?>
        </nav>

        <!-- Menu -->
        <?php
            require("ressources/menu.php");
        ?>


        <div class="banner_container">
            <div class="banner_flou_left"></div>
            <div class="banner"></div>
            <div class="banner_flou_right"></div>
        </div>

        <div class="profile_container">

            <div class="fb_jsa profile_content1">
                <!-- Subscription section -->
                <div class="fb_c ai-c">
                    <div class="fb_jsb profile_subscription_container">
                        <div class="profile_subscription_content" number="1">
                            <p class="fb profile_subscription_number">1213</p>
                            <div class="red_line profile_subscription_line"></div>
                            <p class="profile_subscription_title">Abonnés</p>
                        </div>

                        <div class="profile_subscription_content" number="2">
                            <p class="fb profile_subscription_number">2000</p>
                            <div class="red_line profile_subscription_line"></div>
                            <p class="profile_subscription_title">Abonnements</p>
                        </div>
                    </div>

                    <div class="btn subscribe_btn">S'abonner</div>
                </div>
                <!-- Profile photo + username -->
                <?php
                    echo '<img src="'.$row['user_profile_picture'].'" alt="" class="profile_photo">';
                ?>
            </div>

            <div class="fb_jsb profile_content2">
                <div class="fb profile_bio_container">
                    <?php
                        echo '<p class="profile_username">'.$row['user_username'].'</p>';
                    ?>
                    <div class="red_line profile_line"></div>
                    <?php 
                        echo '<p class="profile_name">'.$row['user_firstname'].'&nbsp;'.$row['user_lastname'].'</p>';
                    ?>
                    <?php 
                        echo '<p class="profile_bio">'.$row['user_profile_description'].'</p>';
                    ?>
                </div>
                <div class="fb_c">
                    <img src="sources/img/modify_icon.svg" class="modify_icon" alt="">
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
                                <p class='pop_corn_number'>515 J'aime</p>
                            </div>

                            <!-- Comment icon -->
                            <div class='fb_jc ai-c'>
                                <img src='sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='fb_jsb share_container'>
                                <img src='sources/img/share_icon.svg' class='share_icon' alt=''>
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
                                <img src='sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                            </div>

                            <!-- Share icon -->
                            <div class='fb_jsb share_container'>
                                <img src='sources/img/share_icon.svg' class='share_icon' alt=''>
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
    <div class="modify_container">
        <form action="oui.php" method="get">
            <!-- Close icon -->
            <img src='sources/img/close_icon.svg' class='modify_close_icon' alt=''>

            <!-- Banner -->
            <div class="modify_banner"></div>

            <div class="modify_profile_photo_container">
                <!-- Profile photo -->
                <?php
                    echo '<img src="'.$row['user_profile_picture'].'" alt="" class="modify_profile_photo">';
                ?>

                <div class="modify_file_container">
                    <!-- Input banner -->
                    <div class="modify_file_banner">
                        <button class="btn modify_btn_banner">Modifier la bannière</button>
                        <input type="file" class="">
                    </div>
                    <!-- Input profile photo -->
                    <div class="modify_file_profile_photo">
                        <button class="btn modify_btn_profile_photo">Modifier la photo de profil</button>
                        <input type="file" class="">
                    </div>

                </div>
            </div>
            <!-- Inputs username, name, bio.. -->
            <div class="modify_input_container">
                <div class="input_container">
                    <label for="username">
                        <span>Nom d'utilisateur</span>
                        <input type="text" class="input_connexion" id="username" name="username">
                    </label>
                </div>
                <div class="input_container">
                    <label for="name">
                        <span>Nom</span>
                        <input type="text" class="input_connexion" id="name" name="name">
                    </label>
                </div>
                <div class="input_container">
                    <label for="website">
                        <span>Site web</span>
                        <input type="text" class="input_connexion" id="website" name="website">
                    </label>
                </div>
                <div class="input_container">
                    <label for="bio">
                        <span>Bio</span>
                        <textarea class="input_connexion input_bio" id="bio" name="bio" cols="30" rows="10"></textarea>
                    </label>
                </div>

                <input type="submit" class="btn modify_btn" value="Modifier">
            </div>
        </form>
    </div>

    <!-- Subscribers and subsciptions page -->
    <div class="pop_up_container subscription_container">
        <div class="pop_up_header subscription_header">
            <!-- Username -->
            <h2>MinminDddddddddddddddd</h2>
            <!-- Close icon -->
            <img src='sources/img/close_icon.svg' class='close_icon' alt=''>
        </div>

        <!-- Title -->
        <div class="subsciption_title_container">
            <div class="subscription_title1 subscriber_title" number="2"><span
                    class="realisation_number_content_number ">1213 </span> Abonnés</div>
            <div class="subscription_title2 subscription_title" number="1"><span
                    class="realisation_number_content_number ">2000 </span> Abonnements</div>
            <div class="red_line subscription_line"></div>
        </div>

        <div class="pop_up_text subscription_content">
            <!-- All subscribers -->
            <div class="subscriber_section">

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscriber_user_btn">Supprimer</div>
                </div>

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscriber_user_btn">Supprimer</div>
                </div>

            </div>

            <!-- All subscriptions -->
            <div class="subscription_section">

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscription_user_btn subcribe_btn_click">Abonné(e)</div>
                </div>

                <!-- User -->
                <div class="subscription_user">
                    <div class="subcription_pp"></div>
                    <div class="subscription_username_container">
                        <div class="subscription_username">Jstm</div>
                        <div class="subscription_name">Julie Saint Martin</div>
                    </div>
                    <div class="btn subscription_user_btn subcribe_btn_click">Abonné(e)</div>
                </div>
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
        <div class="btn pop_up_btn unfollow_btn">Se désabonner</div>
    </div>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/register.js"></script>
    <script src="assets/js/profil.js"></script>
    <!-- <script src="assets/js/fil_actu.js"></script> -->
</body>

</html>