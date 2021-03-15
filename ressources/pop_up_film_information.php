<?php
    if(isset($_GET['comment_send'])){
        $sql = "INSERT INTO comments (comment_content, comment_video_id, comment_user_id) VALUES (:content, :video_id, :user_id)";

        $attributes = array(
          'content' => 'oui',
          'video_id' => '1',
          'user_id' => $_COOKIE['userid'],
        );
    
        $stmt = $db->prepare($sql);
    
        $stmt->execute($attributes);
    
        $db = null;

    header('Location: fil_actu.php?accueil=true');

    }
?>



<!-- Films'informations -->

<div class='dark_filter' onclick="closePopupFilm()"></div>
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
                <div class='film_settings_icon' onclick='filmSettings()'>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>";

                if(func::checkLoginState($db)){ # If the user is connected
                    echo'<img src="sources/img/film_saved_icon.svg" class="film_saved_icon" alt="" onclick="saveFilm($(this))">';
                } else { # If the user is an asshole
                    echo"
                    <img src='sources/img/film_saved_icon.svg' class='film_saved_icon' alt='' onclick='popupConnexion()'>";
                }

        echo"
                <div class='film_settings_container'>
                    <div>Signaler</div>
                    <div class='delete_option' onclick='popupDeleteFilm()'>Supprimer</div>
                    <div>Archiver</div>
                    <div>Modifier</div>
                </div>
            </div>
            <p class='film_title'>{$row["video_title"]}</p>
            <img src='sources/img/close_icon.svg' class='close_icon' alt='' onclick='closePopupFilm()'>
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
                        <div class='defi_icon challenge_defi_icon'></div>
                        <a href='defi_details.php?defi={$row["defi_id"]}' class='challenge_title'>{$row["defi_name"]}</a>
                    </div>

                    <!-- Date + duration section -->
                    <p class='film_time'>{$row["video_duration"]}</p>
                    <p class='film_date'>{$row["video_date"]}</p>
                </div>";

                if(func::checkLoginState($db)){ # If the user is connected
                    echo"<div class='fb_jsb'>

                    <!-- Like section -->
                    <div class='fb_jsb'>
                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon' onclick='likeBtn($(this))'>
                        <p class='film_pop_corn_number'>515 J'aime</p>
                    </div>

                    <!-- Share section -->
                    <div class='fb_jsb share_container' onclick='popupShare()'>
                        <div class='share_icon'></div>
                        <p class='share_title'>Partager</p>
                    </div>
                </div>";
                } else { # If the user is an asshole
                    echo"<div class='fb_jsb'>

                    <!-- Like section -->
                    <div class='fb_jsb' onclick='popupConnexion()'>
                        <img src='sources/img/pop_corn_icon.svg' class='pop_corn_icon'>
                        <p class='film_pop_corn_number'>515 J'aime</p>
                    </div>

                    <!-- Share section -->
                    <div class='fb_jsb share_container' onclick='popupConnexion()'>
                        <div class='share_icon'></div>
                        <p class='share_title'>Partager</p>
                    </div>
                </div>";
                }

            echo"
            </div>

            <p class='film_description'>{$row["video_synopsis"]}</p>

            <div class='fb_jsa genre_distribution_container'>
                <p class='genre_container'><span>Genres</span> <br> {$row["video_genre"]}</p>
                <p class='distribution_container'><span>Distribution</span> <br> {$row["video_distribution"]}</p>
            </div>

        </div>
        <div class='fb_jc ai-c comment_title_container' onclick='popupFilmComment()'>
            <div class='comment_icon'></div>";

            $query = "SELECT COUNT(*) as number FROM comments, videos WHERE comment_video_id=video_id";
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<p class='comment_title'>". $rows['number'] ." commentaires</p>
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
        
        <?php
            if(func::checkLoginState($db)){ # If the user isn't connected
                   
                $query = "SELECT * FROM users WHERE user_id = ".$_COOKIE['userid'].";";
                $stmt = $db->prepare($query);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo"
                    <form action='fil_actu.php?accueil=true' method='GET'>
                        <div class='write_comment'>
                            <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover'  class='pp_profile'></div>
                            <textarea name='comment' class='comment_textarea' name='comment_content' placeholder='Écrire un commentaire...'></textarea>
                            <input type='submit' class='send_comment' name='comment_send' value=''>
                        </div>
                    </form>

                    ";

                } else {

                    echo"
                    <form>
                        <div class='write_comment'  onclick='popupConnexion()'>
                            <div class='se-connecter menu_pp_icon' onclick='redirect(`login.php`)' onload='SVGInject(this)'></div>
                            <textarea name='comment' class='comment_textarea' placeholder='Écrire un commentaire...'></textarea>
                            <input type='submit' class='send_comment' value=''>
                        </div>
                    </form>

                    ";
                }
                $stmt = null;
                $query = null;
                $rows = null;
        ?>

        <!-- All the comments -->
        <?php
        
        $query = "SELECT * FROM comments, users, videos WHERE comment_video_id=video_id AND user_id=comment_user_id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row){
        
            echo "
            <div class='comment_content'>
                <div class='fb_jsb position_r'>
                    <a href='profil.php?id={$row['user_id']}' class='fb'>
                        <div style='background: url(data:image/jpg;base64," . base64_encode($row['user_profile_picture']) .") no-repeat center/cover'  class='pp_profile'></div>
                        <div class='fb_c_jsb pseudo_date_comment'>
                            <p class='pseudo'>{$row["user_username"]}</p>
                            <p class='comment_date'>". date('d-m-Y', strtotime($row["comment_date"])) ."</p>
                        </div>
                    </a>
                    <div class='comment_param_container' onclick='commentFilmSettings($(this))'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>

                    <div class='comment_settings_container'>
                        <div>Signaler</div>
                    </div>
                </div>
    
                <p class='comment_text'>{$row["comment_content"]}</p>
    
                <div class='fb_jsa ai-c'>
                    <div class='fb_jsb'  onclick='popupConnexion()'>
                        <img class='pop_corn_icon' src='sources/img/pop_corn_icon.svg' alt=''>
                        <p class='pop_corn_number'>515 J'aime</p>
                    </div>
                    <div class='fb_jsb comment_container'  onclick='popupConnexion()'>
                        <div class='comment_icon'></div>
                        <p class='comment_number'><nobr>8 réponses</nobr></p>
                    </div>
                    <div class='fb_jsb share_container' onclick='popupShare()'>
                        <div class='share_icon'></div>
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

<div class='delete_dark_filter' onclick='closePopupDeleteFilm()'></div>


<div class='pop_up_container delete_warning'>
    <div class='pop_up_header'>
        <h2>Supprimer</h2>
        <img src='sources/img/close_icon.svg' class='delete_close_icon' alt='' onclick='closePopupDeleteFilm()'>
    </div>
    <p class='pop_up_text'>Es-tu sûr de vouloir supprimer ton court-métrage Je t'haine ?</p>
    <div class='btn pop_up_btn delete_btn'>Supprimer</div>
</div>