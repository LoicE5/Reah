$(document).ready(function () {

    //     // Accueil + nav footer
    if ($(".accueil").length) {
        if ($(".accueil").css('display') == 'none') {
            $(".nav_footer").addClass('flex');
        } else {
            $(".nav_footer").hide();
        }

    }


    $(window).scroll(function () {
        let windowHeight = $(window).height()

        if ($(window).scrollTop() >= windowHeight) {
            $(".accueil").hide();

            let windowWidth = $(window).width();

            if (windowWidth <= 450) {
                $(".nav_footer").addClass('flex');
            }

        } else {
            $(window).resize(function () {
                let windowWidth = $(window).width();
                if (windowWidth >= 450) {
                    $(".nav_footer").hide();
                    $(`#category1,#category2,#category3`).show();
                } else {
                    $(".nav_footer").addClass('flex');
                }
            })
        }

    })

    $(window).resize(function () {

        let windowWidth = $(window).width();
        if (windowWidth >= 450) {
            $(".nav_footer").hide();
            $(`#category1,#category2,#category3`).show();
        } else {
            $(".nav_footer").addClass('flex');
        }
    })


    // Categary title
    $(".category_title,.category_list_category").click(function () {
        let number = $(this).attr("number");
        let number1 = $(this).attr("number1");
        let number2 = $(this).attr("number2");
        console.log("number");
        // $(".category_title").removeClass("category_title_click");
        $(".category_title" + number1 + ",.category_title" + number2 + "").css({
            "color": "var(--text-grey)",
            "font-weight": "400",
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
                scrollTop: 670
            }, "1s");
        } else if (number == "3") {
            $(".underline").addClass("underline3");
            $("html, body").animate({
                scrollTop: 1300
            }, "1s");
        }
    })


    // Category title and underline animation scroll
    $(document).scroll(function () {

        if ($(document).scrollTop() >= 0) {
            $(".category_title").removeClass("category_title_click").css({
                "color": "var(--text_grey)",
                "font-weight": "400",
            });
            $(".category_title1").addClass("category_title_click").css({
                "color": "var(--text)",
                "font-weight": "bold"
            });
            $(".underline").removeClass("underline2 underline3").addClass("underline1");
        }
        if ($(document).scrollTop() >= 670) {
            $(".category_title").removeClass("category_title_click").css({
                "color": "var(--text_grey)",
                "font-weight": "400",
            });
            $(".category_title2").addClass("category_title_click").css({
                "color": "var(--text)",
                "font-weight": "bold"
            });
            $(".underline").removeClass("underline1 underline3").addClass("underline2");
        }
        if ($(document).scrollTop() >= 1300) {
            $(".category_title").removeClass("category_title_click").css({
                "color": "var(--text_grey)",
                "font-weight": "400",
            });
            $(".category_title3").addClass("category_title_click").css({
                "color": "var(--text)",
                "font-weight": "bold"
            });
            $(".underline").addClass("underline3");
        }

    })




    // // Category list animation window width
    // $(window).resize(function () {

    //     if ($(window).width() >= "1050") {
    //         if ($(".category_list_container").hasClass("category_list_container_click") == true) {
    //             $(".category_list_container").removeClass("category_list_container_click").addClass("category_list_container_click3");
    //         }
    //     } else {
    //         if ($(".category_list_container").hasClass("category_list_container_click3") == true) {
    //             $(".category_list_container").addClass("category_list_container_click").removeClass("category_list_container_click3");
    //             $(".menu_nav").removeClass("menu_nav_scroll").addClass("menu_nav_scroll2");
    //         }
    //     }
    // })


    $(".nav_footer_category").click(function () {
        let number = $(this).attr("number");
        let number2 = $(this).attr("number2");
        let number3 = $(this).attr("number3");
        console.log("number");
        // $(".category_title").removeClass("category_title_click");
        // $(".category_title" + number1 + ",.category_title" + number2 + "").css({
        //     "color": "#bbbbbb"
        // });

        $(`#category[number='${number}']`).show();
        $(`#category[number='${number2}'],#category[number='${number3}']`).hide();
        $("html,body").animate({
            scrollTop: 0
        }, "0.2s")



    })

    // $(window).resize(function () {
    //     let windowWidth = $(window).width();
    //     console.log(windowWidth)
    //     if (windowWidth >= 450) {

    //         $(`#category1,#category2,#category3`).show();
    //         $(".nav_footer").hide();
    //     } else {
    //         $(".nav_footer").addClass('flex');

    //     }
    // })



})