  <!-- Menu -->
  <div class="menu_container">

<!-- Profile -->
<a href="profil.php" class="menu_option profil">
    <img src="sources/img/profile_icon.svg" alt="">
    <p class="menu_option_title">Profil</p>
</a>

<!-- Notifications -->
<a href="notifications.php" class="menu_option notifications">
    <img src="sources/img/notifications_icon.svg" alt="">
    <p class="menu_option_title">Notifications</p>
</a>

<a href="saved.php" class="registered menu_option">
    <img src="sources/img/saved_icon.svg" alt="">
    <p class="menu_option_title">Enregistrés</p>
</a>
<a href="settings.php" class="settings menu_option">
    <img src="sources/img/settings_icon.svg" alt="">
    <p class="menu_option_title">Paramètres</p>
</a>

<?php
    if (func::checkLoginState($db)) { # If the user is connected as an admin
        $query = "SELECT * FROM users WHERE user_id = " . $_COOKIE['userid'] . ";";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['user_admin'] >0){
            echo '
            <a href="admin.php" class="backoffice menu_option">
                <!-- <img src="sources/img/disconnection_icon.svg" alt=""> -->
                <p class="menu_option_title">Back Office</p>
            </a>';
        }
    } 
?>
<a href="ressources/logout.php" class="disconnection menu_option">
    <img src="sources/img/disconnection_icon.svg" alt="">
    <p class="menu_option_title">Déconnexion</p>
</a>
</div>