<?php

include('config.php');
include('vimeo_setup.php');

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


$title = $_POST['title'];
$synopsis = $_POST['synopsis'];
$genre = $_POST['genre'];
$collab = $_POST['collab'];
$defi_id = $_POST['video_send'];

$user_id = $_COOKIE['userid'];

$video = $_FILES['video'];
$video_name = $video['name'];
$temp_path = "../../temp/";

uploadFile($video,$temp_path);

echo "<br>$title $synopsis $genre $collab";

$file_name = $temp_path.$video_name;

$uri = $vimeo->upload($file_name, array(
    "name" => $title,
    "description" => $synopsis
));

echo "Your video URI is: $uri";

$vimeo_url_array = explode("/videos/",$uri);
$vimeo_url = $vimeo_url_array[1];

$query = "INSERT INTO videos(video_vimeo_id,video_url,video_title,video_user_id,video_synopsis,video_genre,video_defi_id) VALUES ('$vimeo_url','$vimeo_url','$title',$user_id,'$synopsis','$genre',$defi_id);";
$stmt = $db->prepare($query);
$stmt->execute();

exec("rm -rf ../../temp/*");

sleep(2);
redirect("../../defi_details.php?defi=$defi_id");

?>