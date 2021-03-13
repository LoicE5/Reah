<!DOCTYPE html>
<html lang="fr">

<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head> -->

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
                <a target="_blank" href="mailto:?body=https%3A//fr.wikipedia.org/wiki/Bonjour" class="mail_container">
                    <img src="sources/img/mail_logo.png" class="share_logo" alt="">
                    <p>Mail</p>
                </a>

                <!-- Facebook -->
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A//fr.wikipedia.org/wiki/Bonjour" class="facebook_container">
                    <img src="sources/img/facebook_logo.png" class="share_logo" alt="">
                    <p>Facebook</p>
                </a>

                <!-- Twitter -->
                <a target="_blank" href="https://twitter.com/intent/tweet?text=https%3A//fr.wikipedia.org/wiki/Bonjour" class="twitter_container">
                    <img src="sources/img/twitter_logo.png" class="share_logo" alt="">
                    <p>Twitter</p>
                </a>

                <!-- Messenger -->
                <a target="_blank" href="https://www.facebook.com/dialog/send?app_id=1217981644879628&link=https%3A%2F%2Ffr.wikipedia.org%2Fwiki%2FBonjour&redirect_uri=https%3A%2F%2Ffr.wikipedia.org%2Fwiki%2FBonjour" class="messenger_container">
                    <img src="sources/img/messenger_logo.png" class="share_logo" alt="">
                    <p>Messenger</p>
                </a>

                 <!-- Linkedin -->
                 <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A//fr.wikipedia.org/wiki/Bonjour&title=&summary=&source=" class="linkedin_container">
                    <img src="sources/img/linkedin_logo.png" class="share_logo" alt="">
                    <p>Linkedin</p>
                </a>
            </div>

            <!-- Link -->
            <div class="share_link">
            <p id="tocopy">URL</p>
            <button class="share_btn btn js-copy" data-target="#tocopy">Copier</button>
            </div>
        </div>
    </div>
</body>

</html>