<?php
    include("assets/php/config.php");
    include("ressources/pop_up_film_information.php");
    include("ressources/pop_up_connexion.php");
    include("ressources/pop_up_share.php");
    include('vimeo_setup.php');


if (isset($_GET['send']) && isset($_GET['title']) && isset($_GET['synopsis']) && isset($_GET['genre']) && isset($_GET['collab'])) {

    $sql = "INSERT INTO videos (video_url, video_title, video_user_id, video_synopsis, video_poster, video_genre, video_defi_id) VALUES (:url, :title, :user_id, :synopsis, :poster, :genre, :collab, :defi_id)";

    $attributes = array(
      'url' => $_GET['video'],
      'title' => $_GET['title'],
      'user_id' => $_COOKIE['userid'],
      'synopsis' => $_GET['synopsis'],
      'poster' => $_GET['poster'],
      'genre' => $_GET['genre'],
      'collab' => $_GET['collab'],
      'video' => $_GET['video'],
      'defi_id' => $_GET['defi'],
    );

    $stmt = $db->prepare($sql);

    $stmt->execute($attributes);

    $db = null;

    header('Location: defis.php?success=true');

} 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Défi</title>
    <link rel="stylesheet" href="assets/css/dark_mode.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/defi_details.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/fullpage.css" />
</head>

<body>
    <main class="main_content">
        <!-- Navigation menu -->
        <nav>
            <!-- Logo Réah -->
            <a href="fil_actu.php" class="reah_logo" alt=""></a>

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
                        <img src='".$row['user_profile_picture']."' class='menu_pp' alt='' onclick='toggleBurgerMenu()'>
                        </div>
                        </nav>";
    
                    } else {
    
                        echo "<div class='menu_profile'>
                        <!-- Fil actu icon -->
                        <form action='fil_actu.php' method='GET'>
                            <button type='submit' name='accueil' class='fil_actu_icon' value='true'></button>
                        </form>
                        <!-- Defi icon -->
                        <a href='defis.php' class='defi_icon' alt=''></a>
                        <!-- Profile photo -->
                        <div class='se-connecter' onclick='redirect(`login.php`)'>
                        <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'>

                    </div>
                        </div>
                        </div>
                        </nav>";
                    }
                ?>

            </div>
        </nav>

        <!-- Category list  -->
        <div class="category_list_container">

            <p class="category_list_category category_list_category1" number="1" number1="2" number2="3">Défi</p>
            <p class="category_list_category category_list_category2" number="2" number1="1" number2="3">Couts-métrages</p>
            <p class="category_list_category category_list_category3" number="3" number1="1" number2="2">Classement</p>
        </div>

        <!-- Menu -->
        <?php
            require("ressources/menu.php");
        ?>

        <!-- Nav footer -->

        <div class="nav_footer">
            <div class="nav_footer_category" number="1" number2="2" number3="3">
                <img src="sources/img/loupe_icon.svg" alt="">
                Défi</div>
            <div class="nav_footer_category" number="2" number2="1" number3="3">
                <img src="sources/img/loupe_icon.svg" alt="">
                Courts-métrages</div>
            <div class="nav_footer_category" number="3" number2="1" number3="2">
                <img src="sources/img/loupe_icon.svg" alt="">
                Classement</div>
        </div>


        <div class="all_category_container">

            <!-- "Ajout récent" catégory -->
            <div class="defi_category" id="category1">

                <!-- Title -->
                <?php
               if (isset($_GET["defi"])){
                   
                   $query = "SELECT * FROM defis WHERE defi_id= ".$_GET["defi"]."";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    echo "<h1 id='title1'>
                        <div class='red_line title_line'></div>
                        ". strtoupper($row['defi_name']) ."</h1>";
             
            }
             ?>

                <!-- Constraints -->
                <div class="defi_container">
                    <div class="defi_constraints">
                        <p><b>Contraintes</b></p>
                        <ul>
                            <?php
                            echo "<li>".$row['defi_description']."</li>";
                            ?>
                        </ul>
                    </div>

                    <div class="defi_information">
                    <?php
                    if(func::checkLoginState($db)){ # If the user is connected
                    echo'
                    <div href="depot.php" class="btn depot_btn" onclick="popupAddFilm()">
                        <img class="depot_icon" src="sources/img/depot_icon.svg" alt="">
                        Déposer un court-métrage
                    </div>';
                    } else { # If the user is an asshole
                        echo'
                        <div href="depot.php" class="btn depot_btn" onclick="popupConnexion()">
                            <img class="depot_icon" src="sources/img/depot_icon.svg" alt="">
                            Déposer un court-métrage
                        </div>';
                    }
                    ?>
                       

                        <!-- Time left and number of short films submitted -->
                        <?php
                        if (isset($_GET["defi"])){
                            
                            $query = "SELECT COUNT(video_id) as defi_number FROM defis, videos WHERE defi_id=video_defi_id AND defi_id=".$_GET["defi"]."";
                            $stmt = $db->prepare($query);
                            $stmt->execute();
                            
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                    echo " <p><span>Temps restant</span> 14 heures et 30 minutes</p>";
                    echo " <p><span>Nombre de courts-métrages déposés</span>". $row['defi_number'] ."</p>";
             
            }
            ?>
                    </div>
                </div>
            </div>

            <div class="second_category" id="category2">

                <!-- prev arrow -->
                <div class="arrow_prev_container">
                </div>

                <!-- Category content  -->
                <div class="category_content">

                    <!-- Category title -->
                    <h1 id="title2">
                        <div class="red_line title_line"></div>
                        COURTS-MÉTRAGES
                    </h1>

                    <!-- All videos -->
                    <div class="all_video_container">

                        <?php
                        
                if (isset($_GET["defi"])){

                $query = "SELECT * FROM videos, defis WHERE defi_id=video_defi_id AND defi_id=".$_GET["defi"]."";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($rows as $row){
                    echo "<!-- Video container -->
                    <div class='video_container'>

                        <!-- Short film (class=video) -->
                        <div class='video_content'>
                        <div data-vimeo-id='".$row['video_url']."' data-vimeo-width='auto' id='video_".$row['video_id']."' class='video'></div>
                        <script>
                            let video_".$row['video_id']."_player = new Vimeo.Player('video_".$row['video_id']."');
                        
                            let video_".$row['video_id']."_div = video_".$row['video_id']."_player.element;
                            let video_".$row['video_id']."_iframe;
                            
                            let video_".$row['video_id']."_interval = setInterval(()=>{
                        
                                if(video_".$row['video_id']."_div.firstChild){
                        
                                    video_".$row['video_id']."_iframe = video_".$row['video_id']."_div.firstChild;
                        
                                    let doc = video_".$row['video_id']."_iframe.contentDocument ? video_".$row['video_id']."_iframe.contentDocument :
                                video_".$row['video_id']."_iframe.contentWindow.document;
                        
                                console.log(doc);
                        
                                clearInterval(video_".$row['video_id']."_interval);
                                }
                            });
                        
                        </script>
                            <!-- Name + pp -->
                            <div class='user_container'>
                                <img src='profile_pictures/default.jpg' class='pp_profile' alt=''>
                                <p class='pseudo'>".$row['video_author']."</p>
                                <div class='flou'></div>
                            </div>

                            <!-- Time -->
                            <p class='time'>01:54</p>
                        </div>

                        <!-- Short film\'s informations -->
                        <div class='description_container'>
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container' title=".$row['video_id']." onclick='popupFilm($(this))'>
                                    <h3 class='synopsis_title'>".$row['video_title']."</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                </div>";

                                if(func::checkLoginState($db)){ # If the user is connected
                                echo"
                                <div class='reaction_container'>
                                    <div class='fb_jsb like_container'>
                                        <!-- Pop corn image -->
                                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <div class='share_icon' onclick='popupShare()'></div>

                                </div>";
                                } else { # If the user is an asshole
                                    echo"
                                    <div class='reaction_container'>
                                    <div class='fb_jsb like_container'>
                                        <!-- Pop corn image -->
                                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' onclick='popupConnexion()' >
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <div class='share_icon' onclick='popupConnexion()'></div>

                                </div>";
                                }

                              echo"
                            </div>
                            <p>".$row['video_synopsis']."</p>
                        </div>


                    </div>";
                }

                $stmt = null;
                $query = null;
                $rows = null;

            }
            ?>


                    </div>
                </div>

                <!-- next arrow -->
                <div class="arrow_next_container fp-controlArrow fp-next">
                </div>
            </div>

            <div class="third_category" id="category3">

                <!-- Category content  -->
                <div class="classement_content">

                    <!-- Category title -->
                    <h1 id='title3'>
                        <div class="red_line title_line"></div>
                        CLASSEMENT
                    </h1>

                    <!-- Gold section -->
                    <div class="gold_container">

                        <div class="position_title">
                            <div class="gold_medal"></div>
                            <h2>1<sup>ère</sup> position</h2>
                        </div>

                        <div class="gold_medal" id="medal"></div>


                        <!-- Video container -->
                        <?php
                        
                        if (isset($_GET["defi"])){
        
                        $query = "SELECT * FROM videos, defis WHERE defi_id=video_defi_id AND defi_id=".$_GET["defi"]." ORDER BY video_like_number DESC LIMIT 1";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
        
                        $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
        
                        foreach($rows as $row){

                            echo "<div class='video_container'>
        
                                <!-- Short film (class=video) -->
                                <div class='video_content'>
                                <div data-vimeo-id='".$row['video_url']."' data-vimeo-width='auto' id='video_".$row['video_id']."' class='video'></div>
                                <script>
                                    let video_".$row['video_id']."_player = new Vimeo.Player('video_".$row['video_id']."');
                                
                                    let video_".$row['video_id']."_div = video_".$row['video_id']."_player.element;
                                    let video_".$row['video_id']."_iframe;
                                    
                                    let video_".$row['video_id']."_interval = setInterval(()=>{
                                
                                        if(video_".$row['video_id']."_div.firstChild){
                                
                                            video_".$row['video_id']."_iframe = video_".$row['video_id']."_div.firstChild;
                                
                                            let doc = video_".$row['video_id']."_iframe.contentDocument ? video_".$row['video_id']."_iframe.contentDocument :
                                        video_".$row['video_id']."_iframe.contentWindow.document;
                                
                                        console.log(doc);
                                
                                        clearInterval(video_".$row['video_id']."_interval);
                                        }
                                    });
                                
                                </script>
                                    <!-- Name + pp -->
                                    <div class='user_container'>
                                        <img src='profile_pictures/default.jpg' class='pp_profile' alt=''>
                                        <p class='pseudo'>".$row['video_author']."</p>
                                        <div class='flou'></div>
                                    </div>
        
                                    <!-- Time -->
                                    <p class='time'>01:54</p>
                                </div>
        
                                <!-- Short film\'s informations -->
                                <div class='description_container'>
                                    <div class='fb_jsb'>
                                        <div class='synopsis_title_container' title=".$row['video_id']." onclick='popupFilm($(this))'>
                                            <h3 class='synopsis_title'>".$row['video_title']."</h3>
                                            <p class='see_more'>Voir plus
                                                <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                                </p>
                                        </div>";
        
                                        if(func::checkLoginState($db)){ # If the user is connected
                                        echo"
                                        <div class='reaction_container'>
                                            <div class='fb_jsb like_container'>
                                                <!-- Pop corn image -->
                                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                                                <!-- Like\'s number -->
                                                <p class='pop_corn_number'>515 J'aime</p>
                                            </div>
                                            <!-- Comment icon -->
                                            <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                                <div class='comment_icon'></div>
                                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                            </div>
        
                                            <!-- Share icon -->
                                            <div class='share_icon' onclick='popupShare()'></div>
        
                                        </div>";
                                        } else { # If the user is an asshole
                                            echo"
                                            <div class='reaction_container'>
                                            <div class='fb_jsb like_container'>
                                                <!-- Pop corn image -->
                                                <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                                <!-- Like\'s number -->
                                                <p class='pop_corn_number'>515 J'aime</p>
                                            </div>
                                            <!-- Comment icon -->
                                            <div class='fb_jc ai-c' onclick='popupConnexion()' >
                                                <div class='comment_icon'></div>
                                                <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                            </div>
        
                                            <!-- Share icon -->
                                            <div class='share_icon' onclick='popupConnexion()'></div>
        
                                        </div>";
                                        }
        
                                      echo"
                                    </div>
                                    <p>".$row['video_synopsis']."</p>
                                </div>
        
        
                            </div>";
                            }
                            $stmt = null;
                            $query = null;
                            $rows = null;
                            
                        }
                ?>
                    </div>

                    <!-- Silver container -->
                    <div class='gold_container'>

                        <div class='position_title'>
                            <div class="silver_medal"></div>

                            <h2>2<sup>ème</sup> position</h2>
                        </div>

                        <div class="silver_medal" id="medal"></div>

                        <?php 

                            if (isset($_GET["defi"])){
        
                        $query = "SELECT * FROM videos, defis WHERE defi_id=video_defi_id AND defi_id=".$_GET["defi"]." ORDER BY video_like_number DESC LIMIT 1 OFFSET 1";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
        
                        $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

                        foreach($rows as $row){

                    echo "<!-- Video container -->
                            <div class='video_container'>
        
                                <!-- Short film (class=video) -->
                                <div class='video_content'>
                                <div data-vimeo-id='".$row['video_url']."' data-vimeo-width='auto' id='video_".$row['video_id']."' class='video'></div>
                                <script>
                                    let video_".$row['video_id']."_player = new Vimeo.Player('video_".$row['video_id']."');
                                
                                    let video_".$row['video_id']."_div = video_".$row['video_id']."_player.element;
                                    let video_".$row['video_id']."_iframe;
                                    
                                    let video_".$row['video_id']."_interval = setInterval(()=>{
                                
                                        if(video_".$row['video_id']."_div.firstChild){
                                
                                            video_".$row['video_id']."_iframe = video_".$row['video_id']."_div.firstChild;
                                
                                            let doc = video_".$row['video_id']."_iframe.contentDocument ? video_".$row['video_id']."_iframe.contentDocument :
                                        video_".$row['video_id']."_iframe.contentWindow.document;
                                
                                        console.log(doc);
                                
                                        clearInterval(video_".$row['video_id']."_interval);
                                        }
                                    });
                                
                                </script>
                                    <!-- Name + pp -->
                                    <div class='user_container'>
                                        <img src='profile_pictures/default.jpg' class='pp_profile' alt=''>
                                        <p class='pseudo'>".$row['video_author']."</p>
                                        <div class='flou'></div>
                                    </div>
        
                                    <!-- Time -->
                                    <p class='time'>01:54</p>
                                </div>
        
                                <!-- Short film\'s informations -->
                        <div class='description_container'>
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container' title=".$row['video_id']." onclick='popupFilm($(this))'>
                                    <h3 class='synopsis_title'>".$row['video_title']."</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                </div>";

                                if(func::checkLoginState($db)){ # If the user is connected
                                echo"
                                <div class='reaction_container'>
                                    <div class='fb_jsb like_container'>
                                        <!-- Pop corn image -->
                                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <div class='share_icon' onclick='popupShare()'></div>

                                </div>";
                                } else { # If the user is an asshole
                                    echo"
                                    <div class='reaction_container'>
                                    <div class='fb_jsb like_container'>
                                        <!-- Pop corn image -->
                                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' onclick='popupConnexion()' >
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <div class='share_icon' onclick='popupConnexion()'></div>

                                </div>";
                                }

                              echo"
                            </div>
                            <p>".$row['video_synopsis']."</p>
                        </div>
        
        
                            </div>";
                            }
                            $stmt = null;
                            $query = null;
                            $rows = null;
                        }
                    ?>

                    </div>

                    <!-- Bronze section -->
                    <div class="gold_container">

                        <div class="position_title">
                            <div class="bronze_medal"></div>

                            <h2>3<sup>ème</sup> position</h2>
                        </div>

                        <div class="bronze_medal" id="medal"></div>

                        <!-- Video container -->

                        <?php

                            if (isset($_GET["defi"])){
        
                        $query = "SELECT * FROM videos, defis WHERE defi_id=video_defi_id AND defi_id=".$_GET["defi"]." ORDER BY video_like_number DESC LIMIT 1 OFFSET 2";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
        
                        $rows = $stmt->fetch(PDO::FETCH_ASSOC);

                        foreach($rows as $row){

                        echo "<div class='video_container'>
        
                                <!-- Short film (class=video) -->
                                <div class='video_content'>
                                <div data-vimeo-id='".$row['video_url']."' data-vimeo-width='auto' id='video_".$row['video_id']."' class='video'></div>
                                <script>
                                    let video_".$row['video_id']."_player = new Vimeo.Player('video_".$row['video_id']."');
                                
                                    let video_".$row['video_id']."_div = video_".$row['video_id']."_player.element;
                                    let video_".$row['video_id']."_iframe;
                                    
                                    let video_".$row['video_id']."_interval = setInterval(()=>{
                                
                                        if(video_".$row['video_id']."_div.firstChild){
                                
                                            video_".$row['video_id']."_iframe = video_".$row['video_id']."_div.firstChild;
                                
                                            let doc = video_".$row['video_id']."_iframe.contentDocument ? video_".$row['video_id']."_iframe.contentDocument :
                                        video_".$row['video_id']."_iframe.contentWindow.document;
                                
                                        console.log(doc);
                                
                                        clearInterval(video_".$row['video_id']."_interval);
                                        }
                                    });
                                
                                </script>
                                    <!-- Name + pp -->
                                    <div class='user_container'>
                                        <img src='profile_pictures/default.jpg' class='pp_profile' alt=''>
                                        <p class='pseudo'>".$row['video_author']."</p>
                                        <div class='flou'></div>
                                    </div>
        
                                    <!-- Time -->
                                    <p class='time'>01:54</p>
                                </div>
        
                                <!-- Short film\'s informations -->
                        <div class='description_container'>
                            <div class='fb_jsb'>
                                <div class='synopsis_title_container' title=".$row['video_id']." onclick='popupFilm($(this))'>
                                    <h3 class='synopsis_title'>".$row['video_title']."</h3>
                                    <p class='see_more'>Voir plus
                                        <img src='sources/img/see_more_arrow.svg' class='see_more_arrow' alt=''>
                                        </p>
                                </div>";

                                if(func::checkLoginState($db)){ # If the user is connected
                                echo"
                                <div class='reaction_container'>
                                    <div class='fb_jsb like_container'>
                                        <!-- Pop corn image -->
                                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' title=".$row['video_id']." onclick='popupComment($(this))' >
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <div class='share_icon' onclick='popupShare()'></div>

                                </div>";
                                } else { # If the user is an asshole
                                    echo"
                                    <div class='reaction_container'>
                                    <div class='fb_jsb like_container'>
                                        <!-- Pop corn image -->
                                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='popupConnexion()'>
                                        <!-- Like\'s number -->
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <!-- Comment icon -->
                                    <div class='fb_jc ai-c' onclick='popupConnexion()' >
                                        <div class='comment_icon'></div>
                                        <p class='profile_comment_title'><nobr>1 925 commentaires</nobr></p>
                                    </div>

                                    <!-- Share icon -->
                                    <div class='share_icon' onclick='popupConnexion()'></div>

                                </div>";
                                }

                              echo"
                            </div>
                            <p>".$row['video_synopsis']."</p>
                        </div>
         
                            </div>";

                                }
                            $stmt = null;
                            $query = null;
                            $rows = null;
                        }

?>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Dark filter -->
    <div class='upload_dark_filter' onclick="closePopupAddFilm()"></div>

    <!-- Pop up upload films -->
    <div class="pop_up_container upload_container">
        <form action="">

            <div class="pop_up_header upload_header">
                <h2>Déposer un court-métrage</h2>
                <img src='sources/img/close_icon.svg' class='close_icon' alt='' onclick="closePopupAddFilm()">
            </div>

            <!-- Challenge's name -->
            <p class="defi_title">Défi : Saint-Valentin</p>

            <div class="pop_up_text upload_content">

                <!-- Inputs -->
                <div class="upload_input">
                    <div class="input_container">
                        <label for="title">
                            <span>Titre</span>
                            <input type="text" class="input_connexion" id="title" name="title" required>
                        </label>
                    </div>
                    <div class="input_container input_synopsis">
                        <label for="synopsis">
                            <span>Synopsis</span>
                            <textarea class="input_connexion input_synopsis" id="synopsis" name="synopsis" cols="30"
                                rows="10" required></textarea>
                        </label>
                    </div>
                    <div class="input_container">
                        <label for="genre">
                            <span>Genres</span>
                            <div class="input_tag_container">
                                <p class="input_tag">Action X</p>
                                <p class="input_tag">Thriller X</p>

                            </div>
                            <input type="text" class="input_connexion" id="genre" name="genre" required>
                        </label>
                    </div>
                    <div class="input_container">
                        <label for="collab">
                            <span>Collaborateurs</span>
                            <input type="text" class="input_connexion" id="collab" name="collab" required>
                        </label>
                    </div>
                </div>

                <!-- Video -->
                <div class="upload_video">
                    <!-- Input upload video -->
                    <div class="file_video btn">
                        <button class="btn file_video_btn">Sélectionner un fichier</button>
                        <input type="file" name="video" class="">
                    </div>

                    <!-- Video preview -->
                    <div class="preview_video"></div>

                    <!-- Input upload poster -->
                    <div class="file_poster btn">
                        <button class="btn file_poster_btn">Sélectionner une miniature</button>
                        <input type="file" name="poster" class="">
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

                <button class="btn btn_send" name="send">Valider</button>

            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js">
    </script>
    <script src="assets/js/defi_details.js"></script>
    <script src="assets/js/app2.js"></script>
    <!-- <script src="assets/js/defis.js"></script> -->
    <script src="assets/js/functions.js"></script>
</body>

</html>