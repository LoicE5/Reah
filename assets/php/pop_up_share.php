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
    <title>Film SHARE</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/fil_actu.css">
    <!-- <link rel="stylesheet" href="../css/fil_actu2.css"> -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" defer></script>
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

    <div class="pop_up_container share_film_container" title="'.$row["video_id"].'">
        <div class="pop_up_header">
            <h2>Partager</h2>
            <img src="sources/img/close_icon.svg" class="share_close_icon" alt="" onclick="closePopupShare()">
        </div>
        <div class="pop_up_text">
            <div class="logo_container">

                <!-- Mail -->
                <a target="_blank" href="mailto:?body=https://player.vimeo.com/video/' . $row['video_url']. '" class="mail_container">
                    <img src="sources/img/mail_logo.png" class="share_logo" alt="">
                    <p>Mail</p>
                </a>

                <!-- Facebook -->
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u="https://player.vimeo.com/video/' . $row['video_url'] .'" class="facebook_container">
                    <img src="sources/img/facebook_logo.png" class="share_logo" alt="">
                    <p>Facebook</p>
                </a>

                <!-- Twitter -->
                <a target="_blank" href="https://twitter.com/intent/tweet?text="https://player.vimeo.com/video/' . $row['video_url']. '" class="twitter_container">
                    <img src="sources/img/twitter_logo.png" class="share_logo" alt="">
                    <p>Twitter</p>
                </a>

                <!-- Messenger -->
                <a target="_blank" href="https://www.facebook.com/dialog/send?app_id=1217981644879628&link="https://player.vimeo.com/video/' . $row['video_url'] .'&redirect_uri="https://player.vimeo.com/video/' . $row['video_url'] .'" class="messenger_container">
                    <img src="sources/img/messenger_logo.png" class="share_logo" alt="">
                    <p>Messenger</p>
                </a>

                <!-- Linkedin -->
                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url="https://player.vimeo.com/video/' . $row['video_url'] .'&title=&summary=&source=" class="linkedin_container">
                    <img src="sources/img/linkedin_logo.png" class="share_logo" alt="">
                    <p>Linkedin</p>
                </a>
            </div>

            <!-- Link -->
            <div class="share_link">
                <p id="tocopy">https://player.vimeo.com/video/' . $row["video_url"] . '</p>
                <button class="share_btn btn js-copy" data-target="#tocopy" onclick="docopy(this)">Copier</button>
            </div>
        </div>
    </div>';
}
    ?>
</body>

</html>