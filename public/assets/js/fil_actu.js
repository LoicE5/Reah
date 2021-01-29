$(document).ready(function () {



    // Delete warning pop up 

    $(".delete_option").click(function () {
        $(".delete_warning").fadeIn(500);
        $(".delete_warning").addClass("film_container_open").removeClass("film_container_close");
        $(".delete_dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".delete_dark_filter,.delete_close_icon").click(function () {
        $(".delete_warning").fadeOut();
        $(".delete_warning").addClass("film_container_close").removeClass("film_container_open");
        $(".delete_dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })
    // Synopsis title
    $(".synopsis_title_container").hover(function () {
        $(this).find(".see_more").toggleClass("see_more_hover");
    })

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
    $(".close_icon,.connexion_close_icon,.delete_close_icon").hover(function () {
        $(this).attr('src', 'public/sources/img/close_icon_hover.svg');
    })
    $(".close_icon,.connexion_close_icon,.delete_close_icon").mouseout(function () {
        $(this).attr('src', 'public/sources/img/close_icon.svg');
    })


    // Pop up connexion
    $(".share_icon").click(function () {
        $(".connexion_container").fadeIn(500);
        $(".connexion_container").addClass("film_container_open").removeClass("film_container_close");
        $(".dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".dark_filter,.connexion_close_icon").click(function () {
        $(".connexion_container").fadeOut();
        $(".connexion_container").addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })

     // Saved icon animation click
     $(".film_saved_icon").click(function () {
         if($(this).attr('src') == 'public/sources/img/film_saved_icon_click.svg'){
            $(this).attr('src', 'public/sources/img/film_saved_icon.svg');
        } else {
             $(this).attr('src', 'public/sources/img/film_saved_icon_click.svg');

         }
    })
    

    // Pop up film informations settings
    $(".film_settings_icon").click(function () {
        if ($(".film_settings_container").hasClass("show")) {
            $('.film_settings_container').removeClass("show").addClass("hide"); //Adds 'b', removes 'a'
        } else {
            $('.film_settings_container').removeClass("hide").addClass("show"); //Adds 'a', removes 'b'
        }
    });



    // Comment click animation
    $(".comment_title_container").click(function () {
        if ($(".comment_space_container").hasClass("comment_space_container_open")) {
            $(".comment_space_container").fadeOut(500);
            $(".comment_space_container").addClass("comment_space_container_close").removeClass("comment_space_container_open");

            $("html, body").animate({
                scrollTop: 0
            }, "1s");

            // Comment arrow animation
            $(".comment_arrow").attr('src', 'public/sources/img/bottom_arrow.svg');
        } else {
            $(".comment_space_container").fadeIn(500);
            $(".comment_space_container").addClass("comment_space_container_open").removeClass("comment_space_container_close");
            $("html, body").animate({
                scrollTop: 800
            }, "1s");

            // Comment arrow animation
            $(".comment_arrow").attr('src', 'public/sources/img/top_arrow.svg');
        }
    })



    // Burger menu
    $(".menu_pp").click(function () {
        if ($(".menu_container").hasClass("menu_container_click")) {
            $('.menu_container').removeClass("menu_container_click").addClass("menu_container_click2"); //Adds 'b', removes 'a'
        } else {
            $('.menu_container').removeClass("menu_container_click2").addClass("menu_container_click"); //Adds 'a', removes 'b'
        }
    });

    // Category list 
    $(".category_list,.category_list_container").hover(function () {
        if ($(".category_list_container").hasClass("category_list_container_click")) {
            $('.category_list_container').removeClass("category_list_container_click").addClass("category_list_container_click2"); //Adds 'b', removes 'a'
        } else {
            $('.category_list_container').removeClass("category_list_container_click2").addClass("category_list_container_click"); //Adds 'a', removes 'b'
        }
    });

    // Category title, underline animation click
    $(".category_title1").addClass("category_title_click");

    $(".category_title").hover(function () {
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
                scrollTop: 710
            }, "1s");
        } else if (number == "3") {
            $(".underline").addClass("underline3");
            $("html, body").animate({
                scrollTop: 1400
            }, "1s");
        }
    })


    // Category title and underline animation scroll
    $(document).scroll(function () {
        console.log($(document).scrollTop())

        if ($(document).scrollTop() >= "0") {
            $(".category_title").removeClass("category_title_click");
            $(".category_title1").addClass("category_title_click");
            $(".category_title").css({
                "color": "#bbbbbb"
            });
            $(".category_title1").css({
                "color": "white"
            });
            $(".underline").removeClass("underline2 underline3").addClass("underline1");
        }
        if ($(document).scrollTop() >= "670") {
            $(".category_title").removeClass("category_title_click");
            $(".category_title2").addClass("category_title_click");
            $(".category_title").css({
                "color": "#bbbbbb"
            });
            $(".category_title2").css({
                "color": "white"
            });
            $(".underline").removeClass("underline1 underline3").addClass("underline2");
        }
        if ($(document).scrollTop() >= "1400") {
            $(".category_title").removeClass("category_title_click");
            $(".category_title3").addClass("category_title_click");
            $(".category_title").css({
                "color": "#bbbbbb"
            });
            $(".category_title3").css({
                "color": "white"
            });
            $(".underline").addClass("underline3");
        }

    })

    // Menu opacity
    $(document).scroll(function () {
        // If the mouse is hover the menu or if the menu_container is open
        if ($('.menu_nav:hover').length != 0 || $(".menu_container").hasClass("menu_container_click") || $(".category_list_container").hasClass("category_list_container_click")) {
            // If we are at the top of the page
            if ($(document).scrollTop() == "0") {
                $(".menu_nav").removeClass("menu_nav_scroll menu_nav_scroll2");
            } else {
                $(".menu_nav").removeClass("menu_nav_scroll").addClass("menu_nav_scroll2");
            }
        }
        // If the mouse isn't hover the menu
        else {
            // If we are at the top of the page
            if ($(document).scrollTop() == "0") {
                $(".menu_nav").removeClass("menu_nav_scroll");
                $(".menu_nav").hover(function () {
                    $(".menu_nav").removeClass("menu_nav_scroll menu_nav_scroll2");
                })

            } else {
                $(".menu_nav").addClass("menu_nav_scroll").removeClass("menu_nav_scroll2");
                $(".menu_nav").hover(function () {
                    $(".menu_nav").removeClass("menu_nav_scroll").addClass("menu_nav_scroll2");
                })
            }
        }
    })

    // Video hover
    $(".video").hover(function toggleControls() {
        let videoParent = $(this).parent();
        const video = document.querySelector('.video');
        let user_container = $(videoParent).find(".user_container");
        console.log(videoParent);
        $(user_container).addClass("user_container_mouseout");
        $(videoParent).find(".time").fadeOut();
        this.setAttribute("controls", "controls");

    })
    // Video mouseout
    $(".video").mouseout(function () {
        let videoParent = $(this).parent();
        const video = document.querySelector('.video');
        let user_container = $(videoParent).find(".user_container");
        // If the mouse is over the user_container
        if ($(videoParent).find('.user_container:hover').length != 0) {
            $(user_container).addClass("user_container_hover").removeClass("user_container_mouseout");
            video.setAttribute("controls", "controls");
            $(videoParent).find(".time").fadeOut();

            // If the mouse isn't over the user_container
        } else {
            $(user_container).addClass("user_container_hover").removeClass("user_container_mouseout");
            $(videoParent).find(".time").fadeIn();
            this.removeAttribute("controls", "controls");
        }
    })

    // Film hover
    $(".film").hover(function toggleControls() {
        this.setAttribute("controls", "controls");

        $(this).mouseout(function () {
            this.removeAttribute("controls", "controls");
        })
    })



    // Btn "J'aime" animation click
    $('.pop_corn_icon').on({
        'click': function () {
            var src = ($(this).attr('src') === 'public/img/pop_corn_icon.svg') ?
                'public/sources/img/pop_corn.png' :
                'public/sources/img/pop_corn_icon.svg';
            $(this).attr('src', src);
        }
    });


    // Search bar animation
    if ($(window).width() <= "750") {
        $(".search_bar").focus(function () {
            $(".search_bar").removeClass("search_bar_focusout").addClass("search_bar_focus");
            $(".search_bar::-webkit-input-placeholder").css({
                "color": "#c5c5c5",
            })

        })
        $(".search_bar").focusout(function () {
            $(".search_bar").addClass("search_bar_focusout").removeClass("search_bar_focus");
        })
    }


    // Category list animation window width
    $(window).resize(function () {

        if ($(window).width() >= "1050") {
            if ($(".category_list_container").hasClass("category_list_container_click") == true) {
                $(".category_list_container").removeClass("category_list_container_click").addClass("category_list_container_click3");
            }
        } else {
            if ($(".category_list_container").hasClass("category_list_container_click3") == true) {
                $(".category_list_container").addClass("category_list_container_click").removeClass("category_list_container_click3");
                $(".menu_nav").removeClass("menu_nav_scroll").addClass("menu_nav_scroll2");
            }
        }
    })


    



})