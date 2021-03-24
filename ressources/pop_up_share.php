<?php
$query = "SELECT * FROM `videos`";
$stmt = $db->prepare($query);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <div class="share_dark_filter" onclick="closePopupShare()"></div>

    <div class="pop_up_container share_film_container">
        <div class="pop_up_header">
            <h2>Partager</h2>
            <img src='sources/img/close_icon.svg' class='share_close_icon' alt='' onclick="closePopupShare()">
        </div>
        <div class="pop_up_text">
            <div class="logo_container">

                <!-- Mail -->
                <a target="_blank" href="<?php echo "mailto:?body=https://player.vimeo.com/video/" . $row['video_url'] ?>" class="mail_container">
                    <img src="sources/img/mail_logo.png" class="share_logo" alt="">
                    <p>Mail</p>
                </a>

                <!-- Facebook -->
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "https://player.vimeo.com/video/" . $row['video_url'] ?>" class="facebook_container">
                    <img src="sources/img/facebook_logo.png" class="share_logo" alt="">
                    <p>Facebook</p>
                </a>

                <!-- Twitter -->
                <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo "https://player.vimeo.com/video/" . $row['video_url'] ?>" class="twitter_container">
                    <img src="sources/img/twitter_logo.png" class="share_logo" alt="">
                    <p>Twitter</p>
                </a>

                <!-- Messenger -->
                <a target="_blank" href="https://www.facebook.com/dialog/send?app_id=1217981644879628&link=<?php echo "https://player.vimeo.com/video/" . $row['video_url'] ?>&redirect_uri=<?php echo "https://player.vimeo.com/video/" . $row['video_url'] ?>" class="messenger_container">
                    <img src="sources/img/messenger_logo.png" class="share_logo" alt="">
                    <p>Messenger</p>
                </a>

                <!-- Linkedin -->
                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo "https://player.vimeo.com/video/" . $row['video_url'] ?>&title=&summary=&source=" class="linkedin_container">
                    <img src="sources/img/linkedin_logo.png" class="share_logo" alt="">
                    <p>Linkedin</p>
                </a>
            </div>

            <!-- Link -->
            <div class="share_link">
                <?php
                echo '<p id="tocopy">https://player.vimeo.com/video/' . $row["video_url"] . '</p>';
                ?>
                <button class="share_btn btn js-copy" data-target="#tocopy">Copier</button>
            </div>
        </div>
    </div>
</body>

</html>