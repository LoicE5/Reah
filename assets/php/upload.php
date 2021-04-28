<?php

include('config.php');
include('vimeo_setup.php');

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$title = addslashes($_POST['title']);
$synopsis = addslashes($_POST['synopsis']);
$genre = $_POST['genre'];
$collab = $_POST['collab'];
$defi_id = $_POST['video_send'];

$user_id = $_COOKIE['userid'];

// Poster
$content_dir_poster = '../../database/videos_posters/';
$tmp_file_poster = $_FILES['poster']['tmp_name'];
$name_file_poster = basename($_FILES['poster']['name']);

// Video
$video = $_FILES['video'];
$video_name = $video['name'];
$video_size = $video['size'];
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

$collab_array = explode(", ", $collab);

$duration = $file['playtime_string'];

if($video_size < 100000000){
// Si l'utilisateur a ajouté un poster
if ($_FILES["poster"]['error'] == 0 ) {
        
        if(!is_uploaded_file($tmp_file_poster)) {
        $message_false = "Le fichier est introuvable.";
    }
        
        if(!move_uploaded_file($tmp_file_poster, $content_dir_poster . $name_file_poster)){
        $message_false = "Impossible de copier le fichier dans notre dossier.";
    }
        
        $query = "INSERT INTO videos(video_vimeo_id,video_url,video_title,video_user_id,video_synopsis,video_poster,video_genre,video_defi_id, video_distribution, video_duration) VALUES ('$vimeo_url','$vimeo_url','$title',$user_id,'$synopsis','$name_file_poster','$genre','$defi_id','$collab', '00:$duration')"; 
        
    }else {
        
        $query = "INSERT INTO videos(video_vimeo_id,video_url,video_title,video_user_id,video_synopsis,video_genre,video_defi_id, video_distribution, video_duration) VALUES ('$vimeo_url','$vimeo_url','$title',$user_id,'$synopsis','$genre','$defi_id','$collab', '00:$duration')"; 
    }
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    foreach($collab_array as $collab_id){
        $query2 = "INSERT INTO distribution(distribution_user_id, distribution_video_id) VALUES ('$collab_id', $vimeo_url)";
        $stmt2 = $db->prepare($query2);
        $stmt2->execute();
        
    }
    
    
    exec("rm -rf ../../temp/*");
    
    sleep(2);
    redirect("../../defi_details.php?defi=$defi_id&upload=true");
    
} else {
    exec("rm -rf ../../temp/*");
    redirect("../../defi_details.php?defi=$defi_id&upload=false");

}
?>