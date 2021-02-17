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