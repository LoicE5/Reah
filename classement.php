<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="public/assets/css/profil.css"> -->
</head>
<body>
<div class="third_category">

<!-- Category content  -->
<div class="classement_content">

    <!-- Category title -->
    <h1>CLASSEMENT</h1>

    <!-- All realisations -->
    <div class="all_realisation_container">

        <!-- Realisations's videos -->
        <div class="realisation_container">

            <!-- Video container -->
            <div class='video_container'>

                <!-- Short film -->
                <div class='video_content'>
                    <video class='video' poster='{$films["poster"]}' muted>
                        <source src='{$films["url"]}' type='video/mp4'>
                    </video>

                    <!-- Name + pp -->
                    <div class='user_container'>
                        <img src='{$films["photo"]}' class='pp_profile' alt=''>
                        <p class='pseudo'>{$films["username"]}</p>
                        <div class='flou'></div>
                    </div>

                    <!-- Time -->
                    <p class='time'>{$films["duration"]}</p>
                </div>

                <!-- Short film\'s informations -->
                <div class='description_container'>
                    <div class='reaction_container'>
                        <div class='fb_jsb'>

                            <!-- Pop corn image -->
                            <img class='pop_corn_icon' src='public/sources/img/pop_corn.png' alt=''>
                            <!-- Like\'s number -->
                            <p class='pop_corn_number'>515 J'aime</p>
                        </div>

                        <!-- Comment icon -->
                        <div class='fb_jc ai-c'>
                            <img src='public/sources/img/comment_icon.svg' class='comment_icon' alt=''>
                            <p class='profile_comment_title'>
                                <nobr>1 925 commentaires</nobr>
                            </p>
                        </div>

                        <!-- Share icon -->
                        <div class='fb_jsb share_container'>
                            <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>
                            <p class='share_title'>Partager</p>
                        </div>
                    </div>

                    <div class='fb_c_jsb'>
                        <div class='synopsis_title_container'>
                            <h3 class='synopsis_title'>{$films["title"]}</h3>
                            <p class='see_more'>Voir plus
                                <img src='public/sources/img/see_more_arrow.svg' class='see_more_arrow'
                                    alt=''>
                            </p>
                        </div>

                        <p>{$films["synopsis"]}</p>


                    </div>
                </div>


            </div>

        </div>


    </div>

</div>
</div>
</body>
</html>