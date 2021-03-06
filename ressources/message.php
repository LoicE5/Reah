<!DOCTYPE html>
<html lang="fr">

<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head> -->

<body>
    <div class="pop_up_container message_container">
        <div class="pop_up_header">
            <img src='sources/img/close_icon.svg' class='connexion_close_icon' alt=''>
        </div>
        <div class="pop_up_text">
           
            <?php if (isset($message)){
                echo '<p class="message">'. $message .'</p>';
            }
            ?>
        </div>
    </div>
</body>

</html>