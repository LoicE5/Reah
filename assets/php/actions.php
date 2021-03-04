<?php
include('config.php');

$parameter = htmlspecialchars($_GET['action']);

if($parameter == 'research'){

    $research = htmlspecialchars($_GET['search']);

    $query = "SELECT demo_video_title,demo_video_author,demo_video_url,demo_video_id FROM demo_videos WHERE demo_video_title LIKE '%$research%' OR demo_video_author LIKE '%$research%';";

    $stmt = $db->prepare($query);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($results);

    echo $json;

    echo 'splitter';

    $query = "SELECT user_username,user_profile_picture,user_profile_description FROM users WHERE user_username LIKE '%$research%';";

    $stmt = $db->prepare($query);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($results);

    echo $json;
}

?>