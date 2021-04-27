// Share btn -> copy btn
function docopy(e) {
    var range = document.createRange();
    var target = e.dataset.target;
    var fromElement = document.querySelector(target);
    var selection = window.getSelection();

    range.selectNode(fromElement);
    selection.removeAllRanges();
    selection.addRange(range);

    try {
        var result = document.execCommand('copy');
        if (result) {
            $("body").prepend("<p class='message_true_container'>Lien copié dans le presse-papiers.</p>");
        }
    } catch (err) {
        // Une erreur est surevnue lors de la tentative de copie
        alert(err);
    }

    selection = window.getSelection();

    if (typeof selection.removeRange === 'function') {
        selection.removeRange(range);
    } else if (typeof selection.removeAllRanges === 'function') {
        selection.removeAllRanges();
    }
}

const timeAttrList = document.querySelectorAll("#time");
// console.log(timeAttr1);

function countdownTimer() {
    // let timeAttr = $
    // console.log(timeAttr);
    for (let i in timeAttrList) {

        const difference = +new Date(timeAttrList[i].getAttribute('time')) - +new Date();
    // console.log(difference);

        let remaining = "Défi terminé";

        if (difference > 0) {
            const parts = {
                j: Math.floor(difference / (1000 * 60 * 60 * 24)),
                h: Math.floor((difference / (1000 * 60 * 60)) % 24),
                min: Math.floor((difference / 1000 / 60) % 60),
            };
            remaining = Object.keys(parts).map(part => {
                return `${parts[part]}${part}`;
            }).join(" ");

            timeAttrList[i].innerHTML = remaining;
        } 
        i++
    }
}
setInterval(countdownTimer, 1000);

// PreventDefault
function prevent(e) {
    e.preventDefault();
}

function scrollLeft(selector, distance) {
    let element;
    if (typeof selector == "string") {
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

function scrollRight(selector, distance) {
    let element;
    if (typeof selector == "string") {
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

function redirect(url) {
    if (typeof url == "string") {
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

function searchEngine(input) {
    console.log('triggered');
    let url = `assets/php/actions.php?action=research&search=${input}`;
    let searchbar = document.querySelector('input.search_bar');

    if ((input == null || input == '' || input == undefined) && document.querySelector('#search_list')) {
        console.log('YES TRIGGERED');
        document.querySelector('body').removeChild(document.querySelector('#search_list'));
    } else {

        fetch(url).then(response => {
            response.text().then(text => {
                let splitted = text.split('splitter');

                let videos = JSON.parse(splitted[0]);
                let users = JSON.parse(splitted[1]);
                let defis = JSON.parse(splitted[2]);

                let coordinates = {
                    left: searchbar.offsetLeft,
                    top: Number(searchbar.offsetTop + searchbar.offsetHeight),
                    width: searchbar.offsetWidth
                };

                console.log(coordinates);

                if (!document.querySelector('#search_list')) {
                    let list = document.createElement('div');
                    list.id = 'search_list';
                    list.style = `left: ${coordinates.left}px; top: ${coordinates.top}px; width: ${coordinates.width}px;`;
                    document.body.append(list);
                    console.log(list);
                }

                let searchList = document.querySelector('#search_list');
                // reset du innerHTML
                searchList.innerHTML = '';

                if (defis.length > 0) {

                    searchList.innerHTML += `<h4 style="text-align: center; margin-bottom:0;">Défis</h4>`;

                    for (let i = 0; i < defis.length; i++) {

                        searchList.innerHTML += `<a href="defi_details.php?defi=${defis[i].defi_id}" class="search_list_result">
                            <img style="float: left; height: 20px; margin-right: 15px;" src="database/defis_img/${defis[i].defi_image}" alt="">
                            <p>${defis[i].defi_name}</p>
                            </a>`;

                    }
                }

                if (videos.length > 0) {

                    searchList.innerHTML += `<h4 style="text-align: center; margin-bottom:0;">Courts-métrages</h4>`;

                    for (let i = 0; i < videos.length; i++) {

                        searchList.innerHTML += `<a href="profil.php?id=${videos[i].video_user_id}" class="search_list_result">
                        <p><b><i>${videos[i].video_title}</i></b> de ${videos[i].user_username}</p>
                        </a>`;

                    }
                }


                if (users.length > 0) {

                    searchList.innerHTML += `<h4 style="text-align: center; margin-bottom:0;">Membres</h4>`;

                    for (let i = 0; i < users.length; i++) {

                        searchList.innerHTML += `<a href="profil.php?id=${users[i].user_id}" class="search_list_result">
                        <img style="float: left; width: 20px; height: 20px; border-radius: 999px; margin-right: 15px;" src="database/profile_pictures/${users[i].user_profile_picture}" alt="">
                        <p>${users[i].user_username}</p>
                        </a>`;

                    }
                }

                if (videos.length == 0 && users.length == 0 && defis.length == 0) {
                    searchList.innerHTML += `<p style="padding-left:10px;"> Aucun résultat </p>`;

                }
            });
        });

    }
}

function showLikesAsDisconnected() {

    $(".connexion_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none");

    $(".dark_filter,.connexion_close_icon").click(function () {
        $(".connexion_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none");
    })
}

function addLike(element) {

    let closest_iframe = element.closest('.video_container').querySelector('iframe');
    let video_url = closest_iframe.src;
    let video_vimeo_id = Number(video_url.split('https://player.vimeo.com/video/')[1]); // Basically, split returns an array like ["", "51831727"]


    if ($(element).attr('src') === 'sources/img/pop_corn_icon.svg') {
        console.log(closest_iframe);
        console.log(video_vimeo_id);

        let fetch_url = `assets/php/actions.php?action=addLike&video=${video_vimeo_id}`;

        fetch(fetch_url).then(response => {
            response.text().then(text => {
                let final_count = Number(text);
                console.log(`final_count = ${final_count}`);

                let target = $(element).parent().children('.pop_corn_number');
                console.log(element);
                console.log(target);
                $(target).text(`${final_count} J'aime`);
            });
        });

        $(element).attr('src', 'sources/img/pop_corn.png');
        $(element).addClass('pop_corn_icon_click');

    } else {

        let fetch_url = `assets/php/actions.php?action=removeLike&video=${video_vimeo_id}`;

        fetch(fetch_url).then(response => {
            response.text().then(text => {
                let final_count = Number(text);
                console.log(`final_count = ${final_count}`);

                let target = $(element).parent().children('.pop_corn_number');
                console.log(element);
                console.log(target);
                $(target).text(`${final_count} J'aime`);
            });
        });

        $(element).attr('src', 'sources/img/pop_corn_icon.svg');
        $(element).removeClass('pop_corn_icon_click');

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
        scrollTop: 0
    }, "1s")
}

function closePopupConnexion() {
    $(".connexion_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".connexion_dark_filter").removeClass("show");
    if ($(".dark_filter").css('display') == 'none') {
        $(".main_content").removeClass("scroll_none")
    }
}


// Pop up share
function popupShare(e) {
    // $(".share_film_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".share_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
    let id = e.title;
    console.log(id)
    fetch(`assets/php/pop_up_share.php?id=${id}`).then(response => {
        response.text().then(text => {
            console.log(text);
            document.body.innerHTML += text;
        });
    });
}

function popupUserLike(e) {
    let title = $(e).attr("title");
    // $(`.film_container[title="${title}"]`).fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".like_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")

    let id = e.title;
    fetch(`assets/php/pop_up_user_like.php?id=${id}`).then(response => {
        response.text().then(text => {
            console.log(text);
            document.body.innerHTML += text;
        });
    });


}

function closePopupUserLike() {
    $(".user_like_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".like_dark_filter").removeClass("show");
    if ($(".dark_filter").hasClass("show") == false) {
        $(".main_content").removeClass("scroll_none")

    }
}

function closePopupShare() {
    $(".share_film_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".share_dark_filter").removeClass("show");
    console.log($(".dark_filter").hasClass("show"));
    if ($(".dark_filter").hasClass("show") == false) {
        $(".main_content").removeClass("scroll_none")

    }
}

// Saved icon animation click
function saveFilm(element) {
    // if ($(element).attr('src') == 'sources/img/film_saved_icon_click.svg') {
    //     $(element).attr('src', 'sources/img/film_saved_icon.svg');
    // } else {
    //     $(element).attr('src', 'sources/img/film_saved_icon_click.svg');

    // }

    // let closest_iframe = element.closest('.video_container').querySelector('iframe');
    // let video_url = closest_iframe.src;
    // let video_vimeo_id = Number(video_url.split('https://player.vimeo.com/video/')[1]); // Basically, split returns an array like ["", "51831727"]
    let video_id = $(element).attr('title');

    if ($(element).attr('src') === 'sources/img/film_saved_icon.svg') {
        // console.log(closest_iframe);
        // console.log(video_vimeo_id);

        let fetch_url = `assets/php/actions.php?action=save&video=${video_id}`;

        fetch(fetch_url).then(response => {
            //     response.text().then(text => {
            //         let final_count = Number(text);
            //         console.log(`final_count = ${final_count}`);

            //         let target = $(element).parent().children('.pop_corn_number');
            //         console.log(element);
            //         console.log(target);
            //         $(target).text(`${final_count} J'aime`);
            //     });
        });

        $(element).attr('src', 'sources/img/film_saved_icon_click.svg');

    } else {

        let fetch_url = `assets/php/actions.php?action=unsave&video=${video_id}`;

        fetch(fetch_url).then(response => {
            //     response.text().then(text => {
            //         let final_count = Number(text);
            //         console.log(`final_count = ${final_count}`);

            //         let target = $(element).parent().children('.pop_corn_number');
            //         console.log(element);
            //         console.log(target);
            //         $(target).text(`${final_count} J'aime`);
            //     });
        });

        $(element).attr('src', 'sources/img/film_saved_icon.svg');

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
    // $(`.film_container[title="${title}"]`).fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")

    let id = e.title;
    fetch(`assets/php/film_data.php?id=${id}`).then(response => {
        response.text().then(text => {
            console.log(text);
            document.body.innerHTML += text;
        });
    });


}


function closePopupFilm(element) {
    $(".film_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none");
    document.body.removeChild(element);
    setTimeout(() => {
        for (let i = 0; i < document.querySelectorAll('.film_container').length; i++) {
            document.body.removeChild(document.querySelectorAll('.film_container')[i]);
        }
    }, 1500);
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

    $(`.comment_space_container[title="${title}"]`).fadeIn(500).addClass("comment_space_container_open").removeClass("comment_space_container_close");
    $("html, body").animate({
        scrollTop: 800
    }, "1s");

    let id = e.title;
    fetch(`assets/php/film_data.php?id=${id}`).then(response => {
        response.text().then(text => {
            console.log(text);
            document.body.innerHTML += text;
        });
    });

    // $(`.film_container[title="${title}"]`).fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none");

    // document.querySelector('.film_container').style.display = 'block';


    // Comment arrow animation
    $(".comment_arrow").addClass("comment_arrow_open");




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


// Subscription pop up

function popupSubscription(e) {
    $(".subscription_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".subscription_dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")

    if ($(e).attr("number") == "1") {

        // Subscriber section translate
        $(".subscriber_section,.subscription_section").addClass("subscriber_click2").removeClass("subscriber_click");
        // Line position and width
        let subscriberLeft = $(".subscriber_title").position();
        let subscriberLenght = $(".subscriber_title").width();
        $(".subscription_line").css({
            "width": `${subscriberLenght}px`,
            "transform": `translate(${subscriberLeft.left}px)`
        })
    } else {
        // Subscription section translate
        $(".subscriber_section,.subscription_section").addClass("subscriber_click").removeClass("subscriber_click2");
        // Line position and width
        let subscriptionLeft = $(".subscription_title").position();
        let subscriptionLenght = $(".subscription_title").width();
        $(".subscription_line").css({
            "width": `${subscriptionLenght}px`,
            "transform": `translate(${subscriptionLeft.left}px)`
        })
    }
}


function closePopupSubscription() {
    $(".subscription_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".subscription_dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none");
}

// Pop up to modify film
function popupEditFilm() {
    $(".modify_film_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    $(".dark_filter").addClass("show fixed");
    $(".main_content").addClass("scroll_none")
}

function closePopupEditFilm() {
    $(".modify_film_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    $(".dark_filter").removeClass("show");
    $(".main_content").removeClass("scroll_none")
}



function posterHide(e) {
    $(e).hide();
}