function scrollLeft(selector,distance) {
    let element;
    if(typeof selector == "string"){
        element = document.querySelector(selector);
    } else {
        element = selector;
    }
    console.log('ÇA MARCHE ZEBI');
    element.scrollBy({
      left: -distance,
      behavior: 'smooth'
    });
}

function scrollRight(selector,distance) {
    let element;
    if(typeof selector == "string"){
        element = document.querySelector(selector);
    } else {
        element = selector;
    }
    console.log('ÇA MARCHE ZEBI');
    element.scrollBy({
      left: distance,
      behavior: 'smooth'
    });
}

function redirect(url){
    if(typeof url == "string"){
        window.location = url;
    } else {
        console.log(`Error : wrong redirect input. You entered : ${url}.`)
    }
}

function toggleBurgerMenu() {
    if ($(".menu_container").hasClass("menu_container_click")) {
        $('.menu_container').removeClass("menu_container_click").addClass("menu_container_click2"); //Adds 'b', removes 'a'
    } else {
        $('.menu_container').removeClass("menu_container_click2").addClass("menu_container_click"); //Adds 'a', removes 'b'
    }
}

function searchEngine(input){
    console.log('triggered');
    let url = `assets/php/actions.php?action=research&search=${input}`;
    let searchbar = document.querySelector('input.search_bar');

    if((input == null || input == '' || input == undefined) && document.querySelector('#search_list')){
        console.log('YES TRIGGERED');
        document.querySelector('body').removeChild(document.querySelector('#search_list'));
    } else {

        fetch(url).then(response=>{
            response.text().then(text=>{
                let splitted = text.split('splitter');

                let videos = JSON.parse(splitted[0]);
                let users = JSON.parse(splitted[1]);

                let coordinates = {
                    left: searchbar.offsetLeft,
                    top: Number(searchbar.offsetTop+searchbar.offsetHeight),
                    width: searchbar.offsetWidth
                };

                console.log(coordinates);

                if(!document.querySelector('#search_list')){
                    let list = document.createElement('div');
                    list.id = 'search_list';
                    list.style = `left: ${coordinates.left}px; top: ${coordinates.top}px; width: ${coordinates.width}px;`;
                    document.body.append(list);
                    console.log(list);
                }

                let searchList = document.querySelector('#search_list');
                // reset du innerHTML
                searchList.innerHTML = '';

                searchList.innerHTML += `<h4 style="text-align: center;">Courts-métrages</h4>`;

                for(let i=0;i<videos.length;i++){

                    if(videos.length == 0){

                        searchList.innerHTML += `<p>Aucun résultat</p>`;

                    } else {

                        searchList.innerHTML += `<p class="search_list_result">
                        <b>${videos[i].demo_video_title}</b>
                        de <i>${videos[i].demo_video_author}</i>
                        </p>`;

                    }
                }

                searchList.innerHTML += `<h4 style="text-align: center;">Membres</h4>`;

                for(let i=0;i<users.length;i++){

                    if(users.length == 0){

                        searchList.innerHTML += `<p>Aucun résultat</p>`;

                    } else {

                        searchList.innerHTML += `<p class="search_list_result">
                        <img style="float: left; width: 20px; height: 20px; border-radius: 999px; margin-right: 15px;" src="${users[i].user_profile_picture}" alt="">
                        <b>${users[i].user_username}</b>
                        </p>`;

                    }
                }

            });
        });

    }
}

function showLikesAsDisconnected(){

    $(".connexion_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none");

    $(".dark_filter,.connexion_close_icon").click(function (){
        $(".connexion_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none");
    })
}

function addLike(element){
 
    let closest_iframe = element.closest('.video_container').querySelector('iframe');
    let video_url = closest_iframe.src;
    let video_vimeo_id = Number(video_url.split('https://player.vimeo.com/video/')[1]); // Basically, split returns an array like ["", "51831727"]


    if ($(element).attr('src') === 'sources/img/pop_corn_icon.svg'){
        console.log(closest_iframe);
        console.log(video_vimeo_id);
    
        let fetch_url = `assets/php/actions.php?action=addLike&video=${video_vimeo_id}`;
    
        fetch(fetch_url).then(response=>{
            response.text().then(text=>{
                let final_count = Number(text);
                console.log(`final_count = ${final_count}`);
    
                let target = $(element).parent().children('.pop_corn_number');
                console.log(element);
                console.log(target);
                $(target).text(`${final_count} J'aime`);
            });
        });

     $(element).attr('src', 'sources/img/pop_corn.png');

    } else {

        let fetch_url = `assets/php/actions.php?action=removeLike&video=${video_vimeo_id}`;
    
        fetch(fetch_url).then(response=>{
            response.text().then(text=>{
                let final_count = Number(text);
                console.log(`final_count = ${final_count}`);
    
                let target = $(element).parent().children('.pop_corn_number');
                console.log(element);
                console.log(target);
                $(target).text(`${final_count} J'aime`);
            });
        });

     $(element).attr('src', 'sources/img/pop_corn_icon.svg');

    }


// Btn "J'aime" animation click
// function likeBtn(element) {

// }
}


// Pop up connexion
function popupConnexion() {
    $(".connexion_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".connexion_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
    $("body,.html").animate({
        scrollTop:0
    },"1s")
}

function closePopupConnexion() {
    $(".connexion_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".connexion_dark_filter").removeClass("show");
    if($(".dark_filter").css('display') == 'none'){
        $(".main_content").removeClass("scroll_none")
    } 
}


// Pop up share
function popupShare() {
    $(".share_film_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".share_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupShare() {
    $(".share_film_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".share_dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}

// Saved icon animation click
function saveFilm(e) {
    if ($(e).attr('src') == 'sources/img/film_saved_icon_click.svg') {
        $(e).attr('src', 'sources/img/film_saved_icon.svg');
    } else {
        $(e).attr('src', 'sources/img/film_saved_icon_click.svg');

    }
}


// Pop up film informations settings
function filmSettings() {
    if ($(".film_settings_container").hasClass("show")) {
        $('.film_settings_container').removeClass("show").addClass("hide"); //Adds 'b', removes 'a'
    } else {
        $('.film_settings_container').removeClass("hide").addClass("show"); //Adds 'a', removes 'b'
    }
}


// Arrow click
function nextArrowClick(e) {
    let arrowParent = $(e).closest("#category");
    let videoChild = $(arrowParent).find(".all_video_container")
    let videoPosition = $(arrowParent).find(".video_container").position().left - 110;
    let translate = $(window).width();
    console.log(arrowParent)
    let scroll = translate - videoPosition;

    // console.log(translate)
    $(videoChild).animate({
        scrollLeft: scroll
    }, "1s");
}

function prevArrowClick(e) {

    let arrowParent = $(e).closest("#category");
    let videoChild = $(arrowParent).find(".all_video_container")
    let videoPosition = $(arrowParent).find(".video_container").position().left - 110;
    let translate = $(window).width();
    // console.log($(".video_container").position().left)
    let scroll2 = -videoPosition - translate;
    // console.log(translate)
    $(videoChild).animate({
        scrollLeft: scroll2
    }, "1s");
    // console.log(scroll2)

}


// Pop up information films
function popupFilm(e) {
    let title = $(e).attr("title");
    $(`.film_container[title="${title}"]`).fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupFilm() {
    $(".film_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}


// Delete warning pop up 
function popupDeleteFilm() {
    $(".delete_warning").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".delete_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupDeleteFilm() {
    $(".delete_warning").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".delete_dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}

// Comment icon click

function popupComment(e) {
    let title = $(e).attr("title");
    $(`.film_container[title="${title}"]`).fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none");

    document.querySelector('.film_container').style.display = 'block';

    $(".comment_space_container").fadeIn(500).addClass("comment_space_container_open").removeClass("comment_space_container_close");
    $("html, body").animate({
        scrollTop: 800
    }, "1s");

    // Comment arrow animation
    $(".comment_arrow").addClass("comment_arrow_open");
}

function getFilmComment(element){
    let id = element.title;
    fetch(`ressources/pop_up_film_information.php?id=${id}`).then(response=>{
        response.text().then(text=>{
            console.log(text);
            document.body.innerHTML += text;
        });
    });
}

// Comment click animation
function popupFilmComment() {
    if ($(".comment_space_container").hasClass("comment_space_container_open")) {
        $(".comment_space_container").fadeOut(500).addClass("comment_space_container_close").removeClass("comment_space_container_open");

        $("html, body").animate({
            scrollTop: 0
        }, "1s");

        // Comment arrow animation
        $(".comment_arrow").removeClass("comment_arrow_open");
    } else {
        $(".comment_space_container").fadeIn(500).addClass("comment_space_container_open").removeClass("comment_space_container_close");
        $("html, body").animate({
            scrollTop: 800
        }, "1s");

        // Comment arrow animation
        $(".comment_arrow").addClass("comment_arrow_open");
    }
}


function popupAddDefi() {
    $(".add_defi_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupAddDefi() {
    $(".add_defi_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}



// Pop up upload films
function popupAddFilm() {
    $(".upload_container").fadeIn(500);
    $(".upload_container").addClass("film_container_open").removeClass("film_container_close");
    $(".upload_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupAddFilm() {
    $(".upload_container").fadeOut();
    $(".upload_container").addClass("film_container_close").removeClass("film_container_open");
    $(".upload_dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}

// Pop up user profile settings
function userSettings() {
    if ($(".user_settings_container").hasClass("show")) {
        $('.user_settings_container').removeClass("show").addClass("hide"); //Adds 'b', removes 'a'
    } else {
        $('.user_settings_container').removeClass("hide").addClass("show"); //Adds 'a', removes 'b'
    }
}

// Pop up user profile settings
function commentFilmSettings(e) {
    let parent = $(e).parent();
    let commentSettings = $(parent).children(".comment_settings_container");
    
    if ($(commentSettings).hasClass("flex")) {
        $(commentSettings).removeClass("flex").addClass("hide"); //Adds 'b', removes 'a'
    } else {
        $(commentSettings).removeClass("hide").addClass("flex"); //Adds 'a', removes 'b'
    }
}

function popupDeleteAccount() {
    $(".delete_account_container").fadeIn(500);
    $(".delete_account_container").addClass("film_container_open").removeClass("film_container_close");
    $(".delete_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupDeleteAccount() {
    $(".delete_account_container").fadeOut();
    $(".delete_account_container").addClass("film_container_close").removeClass("film_container_open");
    $(".delete_dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}


function popupSuspendAccount() {
    $(".suspend_account_container").fadeIn(500);
    $(".suspend_account_container").addClass("film_container_open").removeClass("film_container_close");
    $(".delete_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupSuspendAccount() {
    $(".suspend_account_container").fadeOut();
    $(".suspend_account_container").addClass("film_container_close").removeClass("film_container_open");
    $(".delete_dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}

