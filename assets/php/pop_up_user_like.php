<?php
    include('config.php');
    include('vimeo_setup.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film LIKE</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/fil_actu.css">
    <!-- <link rel="stylesheet" href="../css/fil_actu2.css"> -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" defer>
    </script>
    <script src="../js/app2.js" defer></script>
    <script src="../js/functions.js" defer></script>
    <script src="../js/fil_actu.js" defer></script>
</head>

<body>

    <?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    consoleWarn('No ID specified in GET parameters.');
    consoleWarn('$id have been automatically set to 1.');
    $id = 1;
}
$query = "SELECT * FROM `videos` WHERE video_id = $id ";
$stmt = $db->prepare($query);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {

    echo'


    <div class="pop_up_container user_like_container" title="'.$row["video_id"].'">
        <div class="pop_up_header">';
        if(strlen($row["video_title"]) >= 20){
            echo'
            <h2>'.substr($row["video_title"],0, 20).'...</h2>';
        } else {
            echo'
            <h2>'.$row["video_title"].'</h2>';
        }

        echo'
            <img src="sources/img/close_icon.svg" class="share_close_icon" alt="" onclick="closePopupUserLike()">
        </div>
            <div class="user_like_number">
                '.$row["video_like_number"].' J\'aime
            </div>
            <div class="user_like_content">';

            $query2 = "SELECT * FROM users, liked, videos WHERE liked_user_id = user_id AND liked_video_id = $id AND video_id = $id";
                    $stmt2 = $db->prepare($query2);
                    $stmt2->execute();

                    $rows2 = $stmt2->fetchall(PDO::FETCH_ASSOC);

                    foreach ($rows2 as $row2) {
                        echo '
                            <div class="user_like">
                                    <a href="profil.php?id=' . $row2['user_id'] . '"><img src="database/profile_pictures/'.$row2["user_profile_picture"] . '" alt="" class="user_like_pp"></a>
                                    <a href="profil.php?id=' . $row2['user_id'] . '" class="user_like_name_container">
                                        <div class="user_like_username">' . $row2['user_username'] . '</div>
                                        <div class="user_like_name">' . $row2['user_name'] . '</div>
                                    </a>

                            </div>';
                    }
            echo'
            </div>
            
    </div>
    ';

}
?>

</body>

</html>