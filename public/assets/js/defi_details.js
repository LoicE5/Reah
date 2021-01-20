$(document).ready(function(){
    $(".input_tag").click(function(){
        $(this).hide();
    })

    // Pop up upload films
    $(".depot_btn").click(function () {
        $(".upload_container").fadeIn(500);
        $(".upload_container").addClass("film_container_open").removeClass("film_container_close");
        $(".upload_dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".close_icon").click(function () {
        $(".upload_container").fadeOut();
        $(".upload_container").addClass("film_container_close").removeClass("film_container_open");
        $(".upload_dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })
})