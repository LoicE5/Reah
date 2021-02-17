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


    // Arrow click
    $(".arrow_next_container").click(function () {
        let videoPosition = $(".video_container").position().left - 110;
        let translate = $(window).width();
        // console.log(-$(".video_container").position().left)
        let scroll = translate - videoPosition;
        // console.log(translate)
        $(".all_video_container").animate({
            scrollLeft: scroll
        }, "1s");
    })
    $(".arrow_prev_container").click(function () {
        let videoPosition = $(".video_container").position().left - 110;
        let translate = $(window).width();
        // console.log($(".video_container").position().left)
        let scroll2 = -videoPosition - translate;
        // console.log(translate)
        $(".all_video_container").animate({
            scrollLeft: scroll2
        }, "1s");
        // console.log(scroll2)

    })

})