<?php

include('functions.php');

// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);

$db_username = 'root'; # MySQL Username
$db_password = 'root'; # MySQL Password
$db_host = 'localhost'; # MySQL Server
$db_name = 'reah_new'; # MySQL Database name

$db = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);

$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($rows as $row){
//     echo $row["user_username"];
// }

?>