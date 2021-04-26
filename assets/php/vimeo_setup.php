<?php

#Gitignored

require '../vendor/autoload.php';
require_once('../getid3/getid3.php');

use Vimeo\Vimeo;

$client_id = "credential";
$client_secret = "credential";
$access_token = "credential";
// $old_access_token = "credential";

$vimeo = new Vimeo($client_id, $client_secret, $access_token);

$response = $vimeo->request('/tutorial', array(), 'GET');

// Récupérer la durée
$getID3 = new getID3;

$filename = $_FILES["video"]['tmp_name'];
$file = $getID3->analyze($filename);
?>
