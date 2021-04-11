<?php
require '../vendor/autoload.php';
use Vimeo\Vimeo;

$client_id = "credential";
$client_secret = "credential";
$access_token = "credential";
// $old_access_token = "credential";

$vimeo = new Vimeo($client_id, $client_secret, $access_token);

$response = $vimeo->request('/tutorial', array(), 'GET');

?>
