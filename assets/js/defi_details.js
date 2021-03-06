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
    $(".close_icon,.upload_dark_filter").click(function () {
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

    $(".nav_footer_category").click(function () {
        let number = $(this).attr("number");
        let number2 = $(this).attr("number2");
        let number3 = $(this).attr("number3");
        console.log("number");
        // $(".category_title").removeClass("category_title_click");
        // $(".category_title" + number1 + ",.category_title" + number2 + "").css({
        //     "color": "#bbbbbb"
        // });

        let windowWidth = $(window).width();
        console.log(windowWidth)

        // $(this).addClass("category_title_click");
            $(`#category${number}`).show();
            $(`#category${number2},#category${number3}`).hide();
            $("html,body").animate({
                scrollTop: 0
            },"0.2s")
    })

    let windowWidth = $(window).width();

    $(window).resize(function () {
        console.log(windowWidth)
        if (windowWidth >= 450) {
            $(`#category1,#category2,#category3`).css({"display":"flex"});
        } else {
            $(`#category1`).css({"display":"flex"});
            $(`#category2,#category3`).hide();
        }
    })


    $(".category_title,.category_list_category").click(function () {
        let number = $(this).attr("number");
        let number1 = $(this).attr("number1");
        let number2 = $(this).attr("number2");
        console.log("number");
        // $(".category_title").removeClass("category_title_click");
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
                scrollTop: 350
            }, "1s");
        } else if (number == "3") {
            $(".underline").addClass("underline3");
            $("html, body").animate({
                scrollTop: 1000
            }, "1s");
        }
    })


    // Category title and underline animation scroll
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
        if ($(document).scrollTop() >= 350) {
            $(".category_title").removeClass("category_title_click").css({
                "color": "#bbbbbb"
            });
            $(".category_title2").addClass("category_title_click").css({
                "color": "white"
            });
            $(".underline").removeClass("underline1 underline3").addClass("underline2");
        }
        if ($(document).scrollTop() >= 1000) {
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