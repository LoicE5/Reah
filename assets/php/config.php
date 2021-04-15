<?php

include('functions.php');

// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);

$lol = "U won't see our credentials hehe";
echo "<h1>$lol</h1>";

$db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=UTF8",$db_username,$db_password);

// $stmt = $db->prepare("SELECT * FROM users");
// $stmt->execute(); 


?>