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

    console.log(closest_iframe);
    console.log(video_vimeo_id);

    let fetch_url = `assets/php/actions.php?action=addLike&video=${video_vimeo_id}`;

    fetch(fetch_url).then(response=>{
        response.text().then(text=>{
            let final_count = Number(text);
            console.log(`final_count = ${final_count}`);

            let target = element.querySelector('.pop_corn_number>b');
            console.log(element);
            console.log(target);
            target.innerHTML = final_count;
        });
    });
}