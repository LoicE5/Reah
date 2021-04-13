$(document).ready(function () {



    // Search bar animation
    if ($(window).width() <= "750") {
        $(".search_bar").focus(function () {
            $(".search_bar").removeClass("search_bar_focusout").addClass("search_bar_focus");
            $(".search_bar::-webkit-input-placeholder").css({
                "color": "#c5c5c5",
            })
            if ($(window).width() <= "450") {

                $(".menu_profile").hide();
            }
        })
        $(".search_bar").focusout(function () {
            $(".search_bar").addClass("search_bar_focusout").removeClass("search_bar_focus");
            if ($(window).width() <= "450") {

                $(".menu_profile").show();
            }
        })
    }


    
    // Menu opacity
    let lastScrollTop = 0;
    $(window).scroll(function () {
        let st = $(this).scrollTop();
        $(".underline").addClass("underline_opacity");

        // If the mouse is hover the menu or if the menu_container is open
        if ($('nav:hover').length != 0 || $(".menu_container").hasClass("menu_container_click") || $(".category_list_container").hasClass("category_list_container_click")) {
            $(".underline").addClass("underline_opacity");

            // If we are at the top of the page
            if ($(window).scrollTop() == 0) {
                $(".underline").removeClass("underline_opacity");
                $("nav").removeClass("menu_nav_scroll menu_nav_scroll2");
            } else {
                $("nav").removeClass("menu_nav_scroll").addClass("menu_nav_scroll2");
            }
        }
        // If the mouse isn't hover the menu
        else {
            // If we are at the top of the page
            if ($(window).scrollTop() == 0) {
                $(".underline").removeClass("underline_opacity");
                $("nav").removeClass("menu_nav_scroll");
                $("nav").hover(function () {
                    $("nav").removeClass("menu_nav_scroll menu_nav_scroll2");

                })

            } else if (st > lastScrollTop) {
                $("nav").addClass("menu_nav_scroll").removeClass("menu_nav_scroll2");
                $("nav").hover(function () {
                    $("nav").removeClass("menu_nav_scroll").addClass("menu_nav_scroll2");
                })
            } else {
                if ($(window).scrollTop() <= 10) {
                    $("nav").removeClass("menu_nav_scroll menu_nav_scroll2");
                } else {
                    $("nav").removeClass("menu_nav_scroll").addClass("menu_nav_scroll2");
                }
            }
            lastScrollTop = st;

        }
    })



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
            "color": "var(--text)"
        });

        $(this).mouseout(function () {
            if ($(this).hasClass("category_title_click")) {
                $(this).css({
                    "color": "var(--text)"
                });
            } else {
                $(this).css({
                    "color": "var(--text_grey)"
                });
            }
        })
    })




    // Position des titres dans la page
    // console.log(titlePosition2);
    // console.log(titlePosition);


    // Pop up connexion
    // $(".like_container").click(function () {
    //     $(".connexion_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
    //     $(".dark_filter").addClass("show fixed");
    //     $(".main_content").addClass("scroll_none")
    // })
    // $(".dark_filter,.connexion_close_icon").click(function () {
    //     $(".connexion_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
    //     $(".dark_filter").removeClass("show");
    //     $(".main_content").removeClass("scroll_none")
    // })


    // Pop up share
    $(".share_icon, .share_container").click(function () {
        $(".share_film_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
        $(".share_dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".share_dark_filter,.share_close_icon").click(function () {
        $(".share_film_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".share_dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })


    // Saved icon animation click
    $(".film_saved_icon").click(function () {
        if ($(this).attr('src') == 'sources/img/film_saved_icon_click.svg') {
            $(this).attr('src', 'sources/img/film_saved_icon.svg');
        } else {
            $(this).attr('src', 'sources/img/film_saved_icon_click.svg');

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



    let title1Lenght = $(".category_title1").width();
    let title2Lenght = $(".category_title2").width();
    let title3Lenght = $(".category_title3").width();
    let title1Left = $(".category_title1").position();
    let title2Left = $(".category_title2").position();
    let title3Left = $(".category_title3").position();

    let titlePosition = $("#title2").offset().top - 100;
    let titlePosition2 = $("#title3").offset().top - 100;

    // Category title
    $(".category_title,.category_list_category").click(function () {

        let number = $(this).attr("number");
        let number1 = $(this).attr("number1");
        let number2 = $(this).attr("number2");
        let number3 = $(this).attr("number3");
        console.log("number");
        // $(".category_title").removeClass("category_title_click");
        $(".category_title" + number1 + ",.category_title" + number2).css({
            "color": "var(--text-grey)",
            "font-weight": "400",
        });

        $(this).addClass("category_title_click");


        if (number == "1") {
            $("html, body").animate({
                scrollTop: 0
            }, "1s");
            $(".underline").css({
                "width": `${title1Lenght}px`,
                "transform": `translate(${title1Left.left}px)`,
                "transition": "0.5s ease",
            });

        } else if (number == "2") {
            $("html, body").animate({
                scrollTop: titlePosition
            }, "1s");
            $(".underline").css({
                "width": `${title2Lenght}px`,
                "transform": `translate(${title2Left.left}px)`,
                "transition": "0.5s ease",
            });
        } else if (number == "3") {
            $("html, body").animate({
                scrollTop: titlePosition2
            }, "1s");
            $(".underline").css({
                "width": `${title3Lenght}px`,
                "transform": `translate(${title3Left.left}px)`,
                "transition": "0.5s ease",
            });
        }

    })


    // Category title and underline animation scroll
    $(document).scroll(function () {


        if ($(document).scrollTop() >= 0) {
            $(".category_title,.category_list_category").removeClass("category_title_click").css({
                "color": "var(--text_grey)",
                "font-weight": "400",
            });
            $(".category_title1,.category_list_category1").addClass("category_title_click").css({
                "color": "var(--text)",
                "font-weight": "bold"
            });
            $(".underline").css({
                "width": `${title1Lenght}px`,
                "transform": `translate(${title1Left.left}px)`,
                "transition": "0.5s ease",
            });
        }
        if ($(document).scrollTop() >= (titlePosition - 100)) {
            $(".category_title,.category_list_category").removeClass("category_title_click").css({
                "color": "var(--text_grey)",
                "font-weight": "400",
            });
            $(".category_title2,.category_list_category2").addClass("category_title_click").css({
                "color": "var(--text)",
                "font-weight": "bold"
            });
            $(".underline").css({
                "width": `${title2Lenght}px`,
                "transform": `translate(${title2Left.left}px)`,
                "transition": "0.5s ease",
            });
        }
        if ($(document).scrollTop() >= (titlePosition2 - 100)) {
            $(".category_title,.category_list_category").removeClass("category_title_click").css({
                "color": "var(--text_grey)",
                "font-weight": "400",
            });
            $(".category_title3,.category_list_category3").addClass("category_title_click").css({
                "color": "var(--text)",
                "font-weight": "bold"
            });
            $(".underline").css({
                "width": `${title3Lenght}px`,
                "transform": `translate(${title3Left.left}px)`,
                "transition": "0.5s ease",
            });
        }
       

    })



    // Pop up film informations settings icon animation hover
    $(".film_settings_icon").hover(function () {
        $(".film_settings_icon>div").css({
            "background-color": "3f3f3f"
        })
    }, function () {
        $(".film_settings_icon>div").css({
            "background-color": "var(--text-grey)"
        })
    })

    // // Synopsis title
    // $(".synopsis_title_container").hover(function () {
    //     $(this).find(".see_more").toggleClass("see_more_hover");
    // })


    // Close icon animation hover
    $(".close_icon,.connexion_close_icon,.delete_close_icon,.share_close_icon").hover(function () {
        $(this).attr('src', 'sources/img/close_icon_hover.svg');
    })
    $(".close_icon,.connexion_close_icon,.delete_close_icon,.share_close_icon").mouseout(function () {
        $(this).attr('src', 'sources/img/close_icon.svg');
    })


    // Video hover
    $(".video").hover(function toggleControls() {
        let videoParent = $(this).parent();
        const video = document.querySelector('.video');
        let user_container = $(videoParent).find(".user_container");
        let video_poster = $(videoParent).find(".video_poster");
        $(user_container).addClass("user_container_mouseout");
        $(videoParent).find(".time").fadeOut();
        this.setAttribute("controls", "controls");
        // $(video_poster).addClass('fadeOut0to100');

        $(this).mouseout(function () {
            const video = document.querySelector('.video');
            let user_container = $(videoParent).find(".user_container");
            $(user_container).addClass("user_container_hover").removeClass("user_container_mouseout");
            $(videoParent).find(".time").fadeIn();
            this.removeAttribute("controls", "controls");
            // $(video_poster).removeClass('fadeOut0to100');

        })

    })


    $(".video_poster").click(function(){
        $(this).hide();
    })



    $('#genre_select').change(function () {
        let genreTitle = $(this).find("option:selected").attr("value");
        const op = document.querySelectorAll("#genre_select option#option_genre");

        // Ajout d'un genre
        $(".input_tag_container_genre").append(`<p class="input_tag_genre" value="${genreTitle}">${genreTitle} X</p>`);

        for (let i = 0; i < op.length; i++) {
            (op[i].value == genreTitle || op[i].disabled == true) ?
                op[i].disabled = true : op[i].disabled = false;
            
        }

        // Qd on supprime un ge re
        $(".input_tag_genre").click(function () {
            let inputTitle = $(this).attr("value");
            $(this).remove();

            for (let i = 0; i < op.length; i++) {
                (op[i].value == inputTitle || op[i].disabled == false) ?
                op[i].disabled = false : op[i].disabled = true;
            }


            if ($('.input_tag_genre').text().length == 0) {
                const op = document.querySelectorAll("#genre_select option#option_genre_selected");
                for (let i = 0; i < op.length; i++) {
                    op[i].selected = true;
                }
            }
        })
    })

    $('#collab_select').change(function () {
        let collabTitle = $(this).find("option:selected").attr("value");
        let arraycollab = [];
        const op = document.querySelectorAll("#collab_select option#option_collab");

        // Ajout d'un collab
        $(".input_tag_container_collab").append(`<p class="input_tag_collab" value="${collabTitle}">@${collabTitle} X</p>`);

        for (let i = 0; i < op.length; i++) {
            (op[i].value == collabTitle || op[i].disabled == true) ?
                op[i].disabled = true : op[i].disabled = false;
            
        }

        // Qd on supprime un collab
        $(".input_tag_collab").click(function () {
            let inputTitle = $(this).attr("value");
            $(this).remove();

            for (let i = 0; i < op.length; i++) {
                (op[i].value == inputTitle || op[i].disabled == false) ?
                op[i].disabled = false: op[i].disabled = true;
            }

            if ($('.input_tag_collab').text().length == 0) {
                const op = document.querySelectorAll("#collab_select option#option_collab_selected");
                for (let i = 0; i < op.length; i++) {
                    op[i].selected = true;
                }
            }

        })
    })

    $(".btn_send").click(function(){
        let arrayCollab = [];
        let arrayGenre = [];
        const op_collab = document.querySelectorAll("#collab_select option#option_collab");
        const op_genre = document.querySelectorAll("#genre_select option#option_genre");

        // Collab
        for (let i = 0; i < op_collab.length; i++) {
            if (op_collab[i].disabled == true) {
                let user_id = $(op_collab[i]).attr('user_id');
                let arrayPush = arrayCollab.push(user_id);
                // console.log(op_collab[i].value)
            } 
        }

        // Genre
        for (let i = 0; i < op_genre.length; i++) {
            if (op_genre[i].disabled == true) {
                let arrayPush = arrayGenre.push(op_genre[i].value);
                // console.log(op_genre[i].value)
            } 
        }
        // console.log(arraygenre)
        let collabList = arrayCollab.join(', ');
            $("#collab").attr('value', collabList);
        console.log($("#collab").attr('value'))

            let genreList = arrayGenre.join(', ');
            $("#genre").attr('value', genreList);
        console.log($("#genre").attr('value'))
    })
})

