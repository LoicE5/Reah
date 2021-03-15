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
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/fil_actu.css">
    <link rel="stylesheet" href="assets/css/notifications.css">
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
                    redirect('login.php');
                }
            ?>
        </nav>

        <!-- Menu -->
        <?php
            require("ressources/menu.php");
        ?>

        </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script src="assets/js/app2.js"></script>
    <script src="assets/js/functions.js"></script>
</body>
</html>