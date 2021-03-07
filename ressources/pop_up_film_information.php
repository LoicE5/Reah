<!-- Films'informations -->

<div class='dark_filter'></div>
<?php
$query = "SELECT * FROM videos, defis WHERE defi_id=video_defi_id LIMIT 1";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($rows as $row){
echo "
<div class='film_container' title='{$row["video_id"]}'>
    <div class='fb_c'>
        <div class='film_header'>

            <div class='film_settings'>
                <div class='film_settings_icon'>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <img src='sources/img/film_saved_icon.svg' class='film_saved_icon' alt=''>

                <div class='film_settings_container'>
                    <div>Signaler</div>
                    <div class='delete_option'>Supprimer</div>
                    <div>Archiver</div>
                    <div>Modifier</div>
                </div>
            </div>
            <p class='film_title'>{$row["video_title"]}</p>
            <img src='sources/img/close_icon.svg' class='close_icon' alt=''>
        </div>

        <!-- Film -->
        <video class='film' poster='{$row["video_poster"]}' muted>
            <source src='{$row["video_url"]}' type='video/mp4'>
        </video>


        <div class='film_informations'>

            <div class='fb_jsb film_informations_header'>
                <div class='fb_jsb'>

                    <!-- Challenge section -->
                    <div class='fb challenge_container'>
                        <img src='sources/img/defi_icon.svg' class='challenge_defi_icon' alt=''>
                        <a href='defi1.php' class='challenge_title'>{$row["defi_name"]}</a>
                    </div>

                    <!-- Date + duration section -->
                    <p class='film_time'>{$row["video_duration"]}</p>
                    <p class='film_date'>{$row["video_date"]}</p>
                </div>

                <div class='fb_jsb'>

                    <!-- Like section -->
                    <div class='fb_jsb'>
                        <img class='pop_corn_icon' src='sources/img/pop_corn_icon.svg' alt=''>
                        <p class='film_pop_corn_number'>515 J'aime</p>
                    </div>

                    <!-- Share section -->
                    <div class='fb_jsb share_container'>
                        <img src='sources/img/share_icon.svg' class='share_icon' alt=''>
                        <p class='share_title'>Partager</p>
                    </div>
                </div>
            </div>

            <p class='film_description'>{$row["video_synopsis"]}</p>

            <div class='fb_jsa genre_distribution_container'>
                <p class='genre_container'><span>Genres</span> <br> {$row["video_genre"]}</p>
                <p class='distribution_container'><span>Distribution</span> <br> {$row["video_distribution"]}</p>
            </div>

        </div>
        <div class='fb_jc ai-c comment_title_container'>
            <img src='sources/img/comment_icon.svg' class='reaction_icons' alt=''>
            <p class='comment_title'>25 commentaires</p>
            <img src='sources/img/bottom_arrow.svg' class='comment_arrow' alt=''>
        </div>
    </div>";
    }

    $stmt = null;
    $query = null;
    $rows = null;
    ?>
    <!-- Comment -->
    <div class='comment_space_container'>

        <!-- Write a comment -->
        <form>
            <div class='write_comment'>
                <img src='sources/img/profile_photo/jstm.jpg' class='pp_profile' alt=''>
                <textarea name='comment' class='comment_textarea' placeholder='Écrire un commentaire...'></textarea>
                <input type='submit' class='send_comment' value=''>
            </div>
        </form>

        <!-- All the comments -->
        <?php
        
        $query = "SELECT * FROM comments, users, videos WHERE comment_user_id=user_id AND comment_video_id=video_id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row){
        
            echo "
            <div class='comment_content'>
                <div class='fb_jsb'>
                    <div class='fb'>
                        <img src='{$row["user_profile_picture"]}' class='pp_profile' alt=''>
                        <div class='fb_c_jsb pseudo_date_comment'>
                            <p class='pseudo'>{$row["user_username"]}</p>
                            <p class='comment_date'>{$row["comment_date"]}</p>
                        </div>
                    </div>
                    <div class='comment_param_container'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
    
                <p class='comment_text'>{$row["comment_content"]}</p>
    
                <div class='fb_jsa ai-c'>
                    <div class='fb_jsb'>
                        <img class='pop_corn_icon' src='sources/img/pop_corn_icon.svg' alt=''>
                        <p class='pop_corn_number'>515 J'aime</p>
                    </div>
                    <div class='fb_jsb comment_container'>
                        <img class='comment_icon' src='sources/img/comment_icon.svg' alt=''>
                        <p class='comment_number'><nobr>8 réponses</nobr></p>
                    </div>
                    <div class='fb_jsb share_container'>
                        <img class='share_icon' src='sources/img/share_icon.svg' alt=''>
                        <p class='share_title'>Partager</p>
                    </div>
                </div>
            </div>";
        
    }
    
    $stmt = null;
    $query = null;
    $rows = null;
    ?>
    </div>
</div>

<!-- Delete warning -->

<div class='delete_dark_filter'></div>


<div class='pop_up_container delete_warning'>
    <div class='pop_up_header'>
        <h2>Supprimer</h2>
        <img src='sources/img/close_icon.svg' class=' delete_close_icon' alt=''>
    </div>
    <p class='pop_up_text'>Es-tu sûr de vouloir supprimer ton court-métrage Je t'haine ?</p>
    <div class='btn pop_up_btn delete_btn'>Supprimer</div>
</div>