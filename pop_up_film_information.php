<!-- Films'informations -->

<div class='dark_filter'></div>
<?php

                    $requete="SELECT re_films.title as title, re_challenges.title AS challenge, GROUP_CONCAT(username SEPARATOR ', ') AS distribution, url, DATE_FORMAT(duration, '%imin %s' ) AS duration, synopsis, poster, DATE_FORMAT(re_films.date, '%d/%m/%Y') AS date, GROUP_CONCAT(name SEPARATOR ', ') AS genre FROM re_films, re_users, re_a_realise, re_possede, re_genres, re_challenges WHERE id_films=realise_ext_films AND id_users=realise_ext_users AND possede_ext_films=id_films AND possede_ext_genres=id_genres AND re_films.ext_challenges=id_challenges AND id_films='1'";
                    $stmt=$db->query($requete);
                    $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach($resultat as $films){

                        echo "
                        <div class='film_container'>
                        <div class='fb_c'>
                            <div class='film_header'>
                            
        <div class='film_settings'>
            <div class='film_settings_icon'>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <img src='public/sources/img/film_saved_icon.svg' class='film_saved_icon' alt=''>

            <div class='film_settings_container'>
            <div>Signaler</div>
            <div class='delete_option'>Supprimer</div>
            <div>Archiver</div>
            <div>Modifier</div>
        </div>
        </div>
                                <p class='film_title'>{$films["title"]}</p>
                                <img src='public/sources/img/close_icon.svg' class='close_icon' alt=''>
                            </div>
                    
                            <!-- Film -->
                            <video class='film' poster='{$films["poster"]}' muted>
                                <source src='{$films["url"]}' type='video/mp4'>
                            </video>
                    
                    
                            <div class='film_informations'>
                    
                                <div class='fb_jsb film_informations_header'>
                                    <div class='fb_jsb'>
                    
                                        <!-- Challenge section -->
                                        <div class='fb challenge_container'>
                                            <img src='public/sources/img/defi_icon.svg' class='challenge_defi_icon' alt=''>
                                            <a href='defi1.php' class='challenge_title'>{$films["challenge"]}</a>
                                        </div>

                                        <!-- Date + duration section -->
                                        <p class='film_time'>{$films["duration"]}</p>
                                        <p class='film_date'>{$films["date"]}</p>
                                    </div>
                    
                                    <div class='fb_jsb'>
                    
                                        <!-- Like section -->
                                        <div class='fb_jsb'>
                                            <img class='pop_corn_icon' src='public/sources/img/pop_corn_icon.svg' alt=''>
                                            <p class='film_pop_corn_number'>515 J'aime</p>
                                        </div>
                    
                                        <!-- Share section -->
                                        <div class='fb_jsb share_container'>
                                            <img src='public/sources/img/share_icon.svg' class='share_icon' alt=''>
                                            <p class='share_title'>Partager</p>
                                        </div>
                                    </div>
                                </div>
                    
                                <p class='film_description'>{$films["synopsis"]}</p>
                    
                                <div class='fb_jsa genre_distribution_container'>
                                    <p class='genre_container'><span>Genres</span> <br> {$films["genre"]}</p>
                                    <p class='distribution_container'><span>Distribution</span> <br> {$films["distribution"]}</p>
                                </div>
                    
                            </div>
                            <div class='fb_jc ai-c comment_title_container'>
                                <img src='public/sources/img/comment_icon.svg' class='reaction_icons' alt=''>
                                <p class='comment_title'>25 commentaires</p>
                                <img src='public/sources/img/bottom_arrow.svg' class='comment_arrow' alt=''>
                            </div>
                        </div>";
                    };
                    ?>

<!-- Comment -->
<div class='comment_space_container'>

    <!-- Write a comment -->
    <form>
        <div class='write_comment'>
            <img src='public/sources/img/profile_photo/jstm.jpg' class='pp_profile' alt=''>
            <textarea name='comment' class='comment_textarea' placeholder='Écrire un commentaire...'></textarea>
            <input type='submit' class='send_comment' value=''>
        </div>
    </form>

    <!-- All the comments -->
    <?php

                         $requete="SELECT comment, re_comments.date AS date, username,photo FROM re_comments, re_users, re_films WHERE comments_ext_users=id_users AND comments_ext_films=id_films ORDER BY date DESC";
                        $stmt=$db->query($requete);
                        $resultat=$stmt->fetchall(PDO::FETCH_ASSOC);
                        foreach($resultat as $comments){
                        
                        echo "
                            <div class='comment_content'>
                                <div class='fb_jsb'>
                                    <div class='fb'>
                                        <img src='{$comments["photo"]}' class='pp_profile' alt=''>
                                        <div class='fb_c_jsb pseudo_date_comment'>
                                            <p class='pseudo'>{$comments["username"]}</p>
                                            <p class='comment_date'>{$comments["date"]}</p>
                                        </div>
                                    </div>
                                    <div class='comment_param_container'>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                    
                                <p class='comment_text'>{$comments["comment"]}</p>
                    
                                <div class='fb_jsa ai-c'>
                                    <div class='fb_jsb'>
                                        <img class='pop_corn_icon' src='public/sources/img/pop_corn_icon.svg' alt=''>
                                        <p class='pop_corn_number'>515 J'aime</p>
                                    </div>
                                    <div class='fb_jsb comment_container'>
                                        <img class='comment_icon' src='public/sources/img/comment_icon.svg' alt=''>
                                        <p class='comment_number'><nobr>8 réponses</nobr></p>
                                    </div>
                                    <div class='fb_jsb share_container'>
                                        <img class='share_icon' src='public/sources/img/share_icon.svg' alt=''>
                                        <p class='share_title'>Partager</p>
                                    </div>
                                </div>
                            </div>";

                            
                        };
                        
                        ?>
</div>

</div>

<!-- Delete warning -->

<div class="delete_dark_filter"></div>

<div class="delete_warning">
    <div class="delete_warning_header">
        <h2>Supprimer</h2>
        <img src='public/sources/img/close_icon.svg' class=' delete_close_icon' alt=''>
    </div>
    <p>Es-tu sûr de vouloir supprimer ton court-métrage Je t'haine ?</p>
    <div class="delete_btn">Supprimer</div>
</div>