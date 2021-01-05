$(document).ready(function () {


    // Modify icon animation hover
    $(".modify_icon").hover(function () {
        $(this).attr('src', 'public/sources/img/modify_icon_hover.svg');
        // $(this).hide()
    })
    $(".modify_icon").mouseout(function () {
        $(this).attr('src', 'public/sources/img/modify_icon.svg');
    })



    // Profil page -> switch identified and realisation container
    $(".realisation_number_content_title2").click(function () {

        let windowSize = $(window).width();
        $(".all_realisation_container").animate({
            scrollLeft: windowSize
        }, "1s");
    })

    $(".realisation_number_content_title1").click(function () {
        $(".all_realisation_container").animate({
            scrollLeft: 0
        }, "1s");
    })

    // Realisations number title + underline animation hover + click
    $(".realisation_number_content_title1").addClass("category_title_click");

    $(".realisation_number_content_title").hover(function () {
        $(this).css({
            "color": "white"
        });

        $(this).mouseout(function () {
            if ($(this).hasClass("category_title_click")) {
                $(this).css({
                    "color": "white"
                });
            } else {
                $(this).css({
                    "color": "#bbbbbb"
                });
            }
        })
    })

    $(".realisation_number_content_title").click(function () {
        let number = $(this).attr("number");
        console.log("number");
        $(".realisation_number_content_title").removeClass("category_title_click");
        $(".realisation_number_content_title" + number).css({
            "color": "#bbbbbb"
        });

        $(this).addClass("category_title_click");

        if (number == "1") {
            $(".realisation_number_content_line").removeClass("realisation_number_content_line1").addClass("realisation_number_content_line2  ");
        } else if (number == "2") {
            $(".realisation_number_content_line").removeClass("realisation_number_content_line2").addClass("realisation_number_content_line1");
            //   } else if (number == "3") {
            //       $(".underline").addClass("underline3");
            //       $("html, body").animate({
            //           scrollTop: 1400
            //       }, "1s");
        }
    })

    // Pop up to modify profile
    $(".modify_icon").click(function () {
        $(".modify_container").fadeIn(500);
        $(".modify_container").addClass("film_container_open").removeClass("film_container_close");
        $(".dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".dark_filter,.modify_close_icon").click(function () {
        $(".modify_container").fadeOut();
        $(".modify_container").addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })

    // Close icon animation hover
    $(".modify_close_icon").hover(function () {
        $(this).attr('src', 'public/sources/img/close_icon_hover.svg');
    })
    $(".modify_close_icon").mouseout(function () {
        $(this).attr('src', 'public/sources/img/close_icon.svg');
    })
})