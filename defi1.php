<?php
    require("header.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Défi</title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel="stylesheet" href="public/assets/css/fil_actu.css">
    <link rel="stylesheet" href="public/assets/css/defi1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/assets/css/fullpage.css" />

</head>

<body>
    <main class="main_content">


        <!-- Navigation menu -->
        <nav>

            <!-- Logo Réah -->
            <a href="fil_actu.php" class="reah_logo_container"> <img src="public/sources/img/reah_logo_complet.png"
                    class="reah_logo" alt=""></a>


            <div class="menu_nav">
                <!-- Categories's title -->
                <div class="menu_category">
                    <p class="category_title category_title1" number="1" number1="2" number2="3">Défi</p>
                    <p class="category_title category_title2" number="2" number1="1" number2="3">Courts-métrages</p>
                    <p class="category_title category_title3" number="3" number1="1" number2="2">Classement</p>
                    <div class="red_line underline"></div>
                    <div class="fb_jsb ai-c category_list">
                        <p class="category_list_title">Catégories</p>
                        <div class="category_triangle"></div>
                    </div>
                </div>

                <!-- Search bar -->
                <form action="" class="form_search_bar">
                    <input class="search_bar" type="text" placeholder="Défis, courts-métrages, utilisateurs...">
                </form>

                <div class="menu_profile">
                    <!-- Home icon -->
                    <a href="fil_actu.php"> <img src="public/sources/img/fil_actu_icon.svg" class="defi_icon"
                            alt=""></a>
                    <!-- Profile photo -->
                    <!-- Defi icon -->
                    <a href="defis.php"> <img src="public/sources/img/defi_icon.svg" class="defi_icon" alt=""></a>
                    <img src="public/sources/img/pdp.jpg" class="menu_pp" alt="">
                </div>
            </div>
        </nav>

        <!-- Category list  -->
        <div class="category_list_container">

            <p class="category_list_category" number="1" number1="2" number2="3">Défi</p>
            <p class="category_list_category" number="2" number1="1" number2="3">Couts-métrages</p>
            <p class="category_list_category" number="3" number1="1" number2="2">Classement</p>
        </div>

        <!-- Menu -->
        <div class="menu_container">
            <a href="connexion.php" class="menu_option sign_in">Se connecter</a>
            <a href="public/index.php" class="menu_option sign_up">S'inscrire</a>

            <!-- Profile -->
            <a href="profil.php" class="menu_option profil">
                <img src="public/sources/img/profile_icon.svg" alt="">
                <p class="menu_option_title">Profil</p>
            </a>

            <!-- Notifications -->
            <a href="" class="menu_option notifications">
                <img src="public/sources/img/notifications_icon.svg" alt="">
                <p class="menu_option_title">Notifications</p>
            </a>

            <a href="" class="registered menu_option">
                <img src="public/sources/img/saved_icon.svg" alt="">
                <p class="menu_option_title">Enregistrés</p>
            </a>
            <a href="" class="settings menu_option">
                <img src="public/sources/img/settings_icon.svg" alt="">
                <p class="menu_option_title">Paramètres</p>
            </a>
            <a href="" class="disconnection menu_option">
                <img src="public/sources/img/disconnection_icon.svg" alt="">
                <p class="menu_option_title">Déconnexion</p>
            </a>
        </div>

        <!-- "Ajout récent" catégory -->
        <div class="defi_category">

            <!-- Category title -->
            <h1>SAINT-VALENTIN</h1>

            <!-- Challenges container -->
            <div class="defi_container">
                <div class="defi_constraints">
                    <p><b>Contraintes</b></p>
                    <ul>
                        <li>Faire un court-métrage sur le thème de la Saint-Valentin</li>
                    </ul>
                </div>

                <div class="defi_information">
                    <div href="depot.php" class="btn depot_btn">
                        <img class="depot_icon" src="public/sources/img/depot_icon.svg" alt="">
                        Déposer un court-métrage
                    </div>
                    <p><span>Temps restant</span> 14 heures et 30 minutes</p>
                    <p><span>Nombre de courts-métrages déposés</span> 27</p>
                </div>
            </div>
        </div>

        <div class="second_category">

            <!-- prev arrow -->
            <div class="arrow_prev_container">
                <!-- Arrow -->
                <img src="public/sources/img/prev_arrow.svg" class="prev_arrow" alt="">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1 class="title2">COURTS-MÉTRAGES</h1>

                <!-- All videos -->
                <div class="all_video_container">

                    <?php
                    $requete="SELECT title,username,url,DATE_FORMAT(duration, '%imin %s' ) AS duration,synopsis,poster,photo FROM re_films, re_users, re_a_realise WHERE id_films=realise_ext_films AND id_users=realise_ext_users";
                    $stmt=$db->query($requete);
                    $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach($resultat as $films){
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
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container' >
                                    <h3 class='synopsis_title'>{$films["title"]}</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                </div>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c'>
                                        <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>

                                </div>
                            </div>
                            <p>{$films["synopsis"]}</p>
                        </div>


                    </div>
                    
                    ";
                }

                ?>


                </div>
            </div>

            <!-- next arrow -->
            <div class="arrow_next_container fp-controlArrow fp-next">
                <!-- Arrow -->
                <img src="public/sources/img/next_arrow.svg" class="next_arrow" alt="">
            </div>
        </div>

        <div class="third_category">

            <!-- Category content  -->
            <div class="classement_content">

                <!-- Category title -->
                <h1>CLASSEMENT</h1>


                <!-- Gold section -->
                <div class="gold_container">

                    <img src="public/sources/img/gold_medal.png" class="gold_medal" alt="">
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
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container'>
                                    <h3 class='synopsis_title'>{$films["title"]}</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                    </p>
                                </div>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c'>
                                        <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                        <p class='profile_comment_title'>
                                            <nobr>1 925 commentaires</nobr>
                                        </p>
                                    </div>

                                    <!-- Share icon -->
                                    <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>

                                </div>
                            </div>
                            <p>{$films["synopsis"]}Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel iusto,
                                consequatur obcaecati quibusdam saepe itaque praesentium, hic fugiat vero nam quisquam
                                porro doloribus natus atque earum fugit ab totam consectetur! </p>
                        </div>


                    </div>

                </div>


                <!-- Silver container -->
                <div class="gold_container">

                    <img src="public/sources/img/silver_medal.png" class="gold_medal" alt="">
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
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container'>
                                    <h3 class='synopsis_title'>{$films["title"]}</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                    </p>
                                </div>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c'>
                                        <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                        <p class='profile_comment_title'>
                                            <nobr>1 925 commentaires</nobr>
                                        </p>
                                    </div>

                                    <!-- Share icon -->
                                    <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>

                                </div>
                            </div>
                            <p>{$films["synopsis"]}</p>
                        </div>


                    </div>

                </div>

                <!-- Bronze section -->
                <div class="gold_container">

                    <img src="public/sources/img/bronze_medal.png" class="gold_medal" alt="">
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
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container'>
                                    <h3 class='synopsis_title'>{$films["title"]}</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                    </p>
                                </div>
                                <div class='reaction_container'>
                                    <div class='fb_jsb'>
                                        <!-- Pop corn image -->
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c'>
                                        <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                                        <p class='profile_comment_title'>
                                            <nobr>1 925 commentaires</nobr>
                                        </p>
                                    </div>

                                    <!-- Share icon -->
                                    <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>

                                </div>
                            </div>
                            <p>{$films["synopsis"]}</p>
                        </div>


                    </div>

                </div>



            </div>
        </div>
    </main>


    <!-- Dark filter -->
    <div class='upload_dark_filter'></div>

    <!-- Pop up upload films -->
    <div class="pop_up_container upload_container">
        <form action="">

            <div class="pop_up_header upload_header">
                <h2>Déposer un court-métrage</h2>
                <img src='public/sources/img/close_icon.svg' class='close_icon' alt=''>
            </div>

            <!-- Challenge's name -->
            <p class="defi_title">Défi : Saint-Valentin</p>

            <div class="pop_up_text upload_content">

                <!-- Inputs -->
                <div class="upload_input">
                    <div class="input_container">
                        <label for="title">
                            <span>Titre</span>
                            <input type="text" class="input_connexion" id="title" name="title">
                        </label>
                    </div>
                    <div class="input_container input_synopsis">
                        <label for="synopsis">
                            <span>Synopsis</span>
                            <textarea class="input_connexion input_synopsis" id="synopsis" name="synopsis" cols="30"
                                rows="10"></textarea>
                        </label>
                    </div>
                    <div class="input_container">
                        <label for="website">
                            <span>Genres</span>
                            <div class="input_tag_container">
                                <p class="input_tag">Action X</p>
                                <p class="input_tag">Thriller X</p>

                            </div>
                            <input type="text" class="input_connexion" id="website" name="website">
                        </label>
                    </div>
                    <div class="input_container">
                        <label for="collab">
                            <span>Collaborateurs</span>
                            <input type="text" class="input_connexion" id="collab" name="collab">
                        </label>
                    </div>
                </div>

                <!-- Video -->
                <div class="upload_video">
                    <!-- Input upload video -->
                    <div class="file_video">
                        <button class="btn file_video_btn">Sélectionner un fichier</button>
                        <input type="file" class="">
                    </div>

                    <!-- Video preview -->
                    <div class="preview_video"></div>

                    <!-- Input upload poster -->
                    <div class="file_poster">
                        <button class="btn file_poster_btn">Sélectionner une miniature</button>
                        <input type="file" class="">
                    </div>
                </div>

            </div>

            <div class="upload_footer">
                <p>
                    En mettant en ligne des vidéos sur REAH, vous reconnaissez accepter les Conditions d’utilisation et
                    le
                    Règlement de la communauté de REAH. <br>
                    Veillez à ne pas enfreindre les droits d’auteur ni les droits à la vie privée d’autrui.
                </p>

                <button class="btn btn_send">Valider</button>

            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="public/assets/js/defi_details.js"></script>
    <script src="public/assets/js/fil_actu.js"></script>
    <script src="public/assets/js/defis.js"></script>
</body>

</html>