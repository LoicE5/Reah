<?php
    include_once('../assets/php/config.php');
    func::deleteCookie();

    redirect('../index.php');

    if(isset($_GET['delete_account'])){
        include_once('../assets/php/config.php');
        func::deleteCookie();
    
        redirect('../fil_actu.php?delete_account=true');
    }
?>