<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
include('assets/php/config.php');
// include("ressources/pop_up_film_information.php");
include("ressources/pop_up_connexion.php");
// include("ressources/pop_up_share.php");
// include('vimeo_setup.php');



if (isset($_POST['send']) && isset($_POST['title']) && isset($_POST['constraints'])) {
    $title = $_POST['title'];
    if ($title == ' ') {
        $message = 'Le nom choisi est invalide.';
    } else {
        // $title = $_POST['title'];
        // $constraints = $_POST['constraints'];
        // $requete = "INSERT INTO defis (defi_name, defi_description, defi_timestamp, defi_poster) VALUES ($title, $constraints, NULL, NULL)";
        // $stmt=$db->query($requete);

        $sql = "INSERT INTO defis (defi_name, defi_description, defi_timestamp, defi_image, defi_user_id, defi_verified, defi_current) VALUES (:title, :constraints, default, NULL, :user, 0, 0)";

        $attributes = array(
            'title' => addslashes($_POST['title']),
            'constraints' => addslashes($_POST['constraints']),
            'user' => $_COOKIE['userid']
        );

        $stmt = $db->prepare($sql);

        $stmt->execute($attributes);

        header('Location: defis.php?success=true');
        
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>REAH | Défis</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/defis.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/fullpage.css" />
</head>

<body>
    <main class="main_content">


        <?php if (isset($message)) {
            echo '<p class="message_true_container">' . $message . '</p>';
        }

        if (isset($_GET['success'])) {
            echo '
            <p class="message_true_container">
                    Ton défi a bien été pris en compte !
            </p>';
        }
        ?>

        <!-- Navigation menu -->
        <nav>

            <!-- Logo Réah -->
            <a href="fil_actu.php" class="reah_logo"></a>

            <div class="menu_nav">
                <!-- Categories's title -->
                <div class="menu_category">
                    <p class="category_title category_title1" number="1" number1="2">Défis du moment</p>
                    <p class="category_title category_title2" number="2" number1="1">Défis à découvrir</p>
                    <div class="red_line underline"></div>
                    <div class="fb_jsb ai-c category_list">
                        <p class="category_list_title">Catégories</p>
                        <div class="category_triangle"></div>
                    </div>
                </div>

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
                        <!-- Profile photo -->
                        <img src='database/profile_pictures/".$row['user_profile_picture']."' class='menu_pp' onclick='toggleBurgerMenu()'>
                        </div>
                        </nav>";
                } else {

                    echo "<div class='menu_profile'>
                        <!-- Fil actu icon -->
                        <form action='fil_actu.php' method='GET'>
                            <button type='submit' name='accueil' class='fil_actu_icon' value='true'></button>
                        </form>
                        <!-- Profile photo -->
                        <div class='se-connecter' onclick='redirect(`login.php`)'>
                        <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'>
                        </div>
                        </div>
                        </nav>";
                }
                ?>
            </div>
        </nav>

        <!-- Category list  -->
        <div class="category_list_container">
            <p class="category_list_category category_list_category1" number="1" number1="2">Défis du moment</p>
            <p class="category_list_category category_list_category2" number="2" number1="1">Défis à découvrir</p>
        </div>

        <!-- Menu -->
        <?php
        require("ressources/menu.php");
        ?>

        <!-- "Ajout récent" catégory -->
        <div class="first_category">


            <div class="add_defi_btn_container">
                <!-- Category title -->
                <h1 id="title1">
                    <div class="red_line title_line"></div>
                    <div id='days'></div>
                    DÉFIS DU MOMENT
                    <div class='help_icon_container'>
                            <img src='sources/img/help_icon.png' alt='' class='help_icon'>
                            <p class='help_message'>La catégorie "Défis du moment" présente les deux défis auxquels tu peux participer. Les défis du moment changent tous les mois.</p>
                        </div>
                </h1>

                <!-- Add defi btn -->
                <?php
                if (func::checkLoginState($db)) { # If the user is connected
                    echo '
                <div class="btn add_defi_btn" onclick="popupAddDefi()">
                    <img class="add_defi_icon" src="sources/img/add_defi_icon.svg" alt="">
                    Proposer un défi
                </div>';
                } else { # If the user is an asshole
                    echo '
                    <div class="btn add_defi_btn" onclick="popupConnexion()">
                        <img class="add_defi_icon" src="sources/img/add_defi_icon.svg" alt="">
                        Proposer un défi
                    </div>';
                }
                ?>
            </div>

            <!-- Challenges container -->
            <div class="defi_container ">

                <?php
                $query = "SELECT * FROM defis WHERE defi_verified='1' AND defi_current='1'";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


                foreach ($rows as $row) {
                    echo '
                        <a href="defi_details.php?defi=' . $row['defi_id'] . '" class="defi_content">
                        <img src="database/defis_img/'.$row['defi_image'].'" alt="" class="defi_img defi1_img">
                        <p class="defi_time">Temps restant : <span id="time" time='.$row['defi_date_end'].'></span></p>
                    </a>';
                }
                ?>
                <!--  -->
            </div>
        </div>


        <div class="second_category" id="category">

            <!-- prev arrow -->
            <div class="arrow_prev_container fp-controlArrow fp-prev">
            </div>

            <!-- Category content  -->
            <div class="category_content">

                <!-- Category title -->
                <h1 id="title2">
                    <div class="red_line title_line"></div>
                    À DÉCOUVRIR
                    <div class='help_icon_container'>
                            <img src='sources/img/help_icon.png' alt='' class='help_icon'>
                            <p class='help_message'>La catégorie "À découvrir" présente tous les défis de REAH.</p>
                        </div>
                </h1>

                <div class="defi_pop_container ">


                    <?php
                    $query = "SELECT * FROM defis WHERE defi_verified='1' ORDER BY RAND()";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    foreach ($rows as $row) {
                        echo '
                        <a href="defi_details.php?defi=' . $row['defi_id'] . '" class="defi_pop_content">
                                                <img src="database/defis_img/'.$row['defi_image'].'" alt="" class="defi_img defi1_img">

                        </a>';
                    }
                    ?>
                    <!-- <p class="defi_pop_title">'. strtoupper($row['defi_name']) .'</p> -->

                </div>
            </div>

            <!-- next arrow -->
            <div class="arrow_next_container fp-controlArrow fp-next">
            </div>
        </div>

        <?php
        require("ressources/footer.php");
        ?>
    </main>




    <!-- Pop up add defi -->

    <div class="dark_filter" onclick="closePopupAddDefi()"></div>

    <div class="pop_up_container add_defi_container">
        <form action="defis.php" method=POST>
            <div class="pop_up_header">
                <h2>Proposer un défi</h2>
                <img src='sources/img/close_icon.svg' class='close_icon' alt='' onclick="closePopupAddDefi()">
            </div>
            <div class="pop_up_text">

                <!-- Inputs -->
                <div class="add_defi_input">
                    <div class="input_container">
                        <label for="title">
                            <span>Titre</span>
                            <input type="text" class="input_connexion" id="title" name="title" required>
                        </label>
                    </div>
                    <div class="input_container input_constraints_container">
                        <label for="constraints">
                            <span>Contraintes</span>
                            <textarea class="input_connexion input_constraints" id="constraints" name="constraints" cols="30" rows="10" required></textarea>
                        </label>
                    </div>

                </div>
            </div>

            <input type="submit" class="pop_up_btn btn send_btn" name="send" value="Envoyer"></input>
        </form>
    </div>

    <?php

    ?>

    <script type="text/javascript" src="assets/js/libraries/jquery/jquery.min.js"></script>
    <!-- <script src="assets/js/app.js"></script> -->
    <!-- <script src="assets/js/register.js"></script> -->
    <script src="assets/js/defis.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>

</body>

</html>