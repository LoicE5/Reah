$(document).ready(function(){

    $(".defi_content").hover(function () {
        let number = $(this).attr("defi");
        if ($('.defi_title:hover').length == 0 || $('.defi_content:hover').length == 0) {
            $(".defi" + number + "_img").removeClass("defi_img_hover").addClass("defi_img_mouseout");
            $(".defi" + number + "_title").removeClass("defi_title_hover").addClass("defi_title_mouseout");
        }
        if ($('.defi_title:hover').length != 0 || $('.defi_content:hover').length != 0) {
            $(".defi" + number + "_img").addClass("defi_img_hover").removeClass("defi_img_mouseout");
            $(".defi" + number + "_title").addClass("defi_title_hover").removeClass("defi_title_mouseout");
        }
        
    })

    $(".add_defi_btn").click(function () {
        $(".add_defi_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
        $(".dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".dark_filter,.close_icon").click(function () {
        $(".add_defi_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".delete_dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })


    // Arrow click
    $(".arrow_next_container").click(function () {
        let arrowParent =  $(this).closest("#category");
        let videoChild = $(arrowParent).find(".defi_pop_container")
        let videoPosition = $(arrowParent).find(".defi_pop_content").position().left - 110;
        let translate = $(window).width();
        // console.log(-$(".video_container").position().left)
        let scroll = translate - videoPosition;
        // console.log(translate)
        $(videoChild).animate({
            scrollLeft: scroll
        }, "1s");
    })
    $(".arrow_prev_container").click(function () {
        let arrowParent =  $(this).closest("#category");
        let videoChild = $(arrowParent).find(".defi_pop_container")
        let videoPosition = $(arrowParent).find(".defi_pop_content").position().left - 110;
        let translate = $(window).width();
        // console.log($(".video_container").position().left)
        let scroll2 = -videoPosition - translate;
        // console.log(translate)
        $(videoChild).animate({
            scrollLeft: scroll2
        }, "1s");
        // console.log(scroll2)

    })

    // Category title, underline animation click
    $(".category_title,.category_list_category").click(function () {
        let number = $(this).attr("number");
        let number1 = $(this).attr("number1");
        let number2 = $(this).attr("number2");
        console.log("number");
        $(".category_title").removeClass("category_title_click");
        $(".category_title" + number1 + ",.category_title" + number2 + "").css({
            "color": "#bbbbbb"
        });

        $(this).addClass("category_title_click");
        if (number == "1") {
            $(".underline").removeClass("underline2 underline3").addClass("underline1");
            $("html, body").animate({
                scrollTop: 0
            }, "1s");
        } else if (number == "2") {
            $(".underline").removeClass("underline1 underline3").addClass("underline2");
            $("html, body").animate({
                scrollTop: 500
            }, "1s");
        } else if (number == "3") {
            $(".underline").addClass("underline3");
            $("html, body").animate({
                scrollTop: 900
            }, "1s");
        }
    })

    $(document).scroll(function () {
        console.log($(document).scrollTop())

        if ($(document).scrollTop() >= 0) {
            $(".category_title").removeClass("category_title_click").css({
                "color": "#bbbbbb"
            });
            $(".category_title1").addClass("category_title_click").css({
                "color": "white"
            });
            $(".underline").removeClass("underline2 underline3").addClass("underline1");
        }
        if ($(document).scrollTop() >= 500) {
            $(".category_title").removeClass("category_title_click").css({
                "color": "#bbbbbb"
            });
            $(".category_title2").addClass("category_title_click").css({
                "color": "white"
            });
            $(".underline").removeClass("underline1 underline3").addClass("underline2");
        }
        if ($(document).scrollTop() >= 900) {
            $(".category_title").removeClass("category_title_click").css({
                "color": "#bbbbbb"
            });
            $(".category_title3").addClass("category_title_click").css({
                "color": "white"
            });
            $(".underline").addClass("underline3");
        }


    })

})