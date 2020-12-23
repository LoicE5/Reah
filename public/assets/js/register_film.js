$(document).ready(function(){
    
    // Pop up information films
    $(".synopsis_title_container").click(function () {
        $(".film_container").fadeIn(500);
        $(".film_container").addClass("film_container_open").removeClass("film_container_close");
        $(".dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".dark_filter,.close_icon").click(function () {
        $(".film_container").fadeOut();
        $(".film_container").addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })

    // Close icon animation hover
    $(".close_icon").hover(function () {
        $(this).attr('src', 'public/img/close_icon_hover.svg');
    })
    $(".close_icon").mouseout(function () {
        $(this).attr('src', 'public/img/close_icon.svg');
    })



    // Comment click animation
    $(".comment_title_container").click(function () {
        if ($(".comment_space_container").hasClass("comment_space_container_open")) {
            $(".comment_space_container").fadeOut(500);
            $(".comment_space_container").addClass("comment_space_container_close").removeClass("comment_space_container_open");

            $("html, body").animate({
                scrollTop: 0
            }, "1s");

            // Comment arrow animation
            $(".comment_arrow").attr('src', 'public/img/bottom_arrow.svg');
        } else {
            $(".comment_space_container").fadeIn(500);
            $(".comment_space_container").addClass("comment_space_container_open").removeClass("comment_space_container_close");
            $("html, body").animate({
                scrollTop: 800
            }, "1s");

            // Comment arrow animation
            $(".comment_arrow").attr('src', 'public/img/top_arrow.svg');
        }
    })
})