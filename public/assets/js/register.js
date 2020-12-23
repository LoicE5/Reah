const body = document.querySelector('body');
const firstForm = document.querySelector('.form_container');
const secondForm = document.querySelector('.form_container2');
const thirdForm = document.querySelector('.form_container3');
const nextButton = document.querySelector('.btn_next');
const previousButton = document.querySelector('.btn_prev');
const inputMdp = document.querySelector('.input_mdp');
const inputMdpVerif = document.querySelector('.input_mdp_verif');
const inputFirstForm = document.querySelectorAll('.first_form');
const inputSecondForm = document.querySelectorAll('.second_form');
const inputThirdForm = document.querySelectorAll('.third_form');
const iconRestriction = document.querySelector('.icon_restriction');
const restriction = document.querySelector('.restriction');
const restrictionContainer = document.querySelector('.restriction_container');
const previousButton2 = document.querySelector('.btn_prev2');
const inscriptionButton = document.querySelector('.btn_inscription');
const validationButton = document.querySelector('.btn_connexion');
const formOneContent = document.querySelector('#form1');
const formTwoContent = document.querySelector('#form2');



body.addEventListener('click', (e) => {

    // Animation click first arrow
    const line = document.querySelector('.line');
    const line2 = document.querySelector('.line2');

    if (e.target === previousButton || e.target === line)

    {

        previousForm(secondForm, firstForm);

    }

    // Animation click second arrow
    else if (e.target === previousButton2 || e.target === line2)

    {

        previousForm(thirdForm, secondForm);

    }

    // Animation restriction password
    else if (e.target === inputMdp)

    {

        toggleClass(iconRestriction, 'show');
        iconRestriction.classList.add('rotate');
        // toggleClass(restriction, 'show');
        toggleClass(restrictionContainer, 'flex');

    }

})

// Translate des form_container

body.addEventListener('change', (e) =>

    {

        verifForm(e.target, "first_form", nextButton, inputFirstForm, nextForm, firstForm, secondForm);

        verifForm(e.target, "second_form", inscriptionButton, inputSecondForm, null, null, null, "password_verif", inputMdp, inputMdpVerif);

        verifForm(e.target, "third_form", validationButton, inputThirdForm, null, null, null);


    })

body.addEventListener('submit', e =>

    {

        e.preventDefault();

        if (e.target === formOneContent && inscriptionButton.classList.contains("can_click"))

        {

            const formData = new FormData(formOneContent);

            fetch("../register.php",

                    {
                        method: "POST",
                        body: formData

                    })

                .then(response =>

                    {

                        return response.json();

                    }

                )
                .then(jsonResp =>

                    {

                        let error = false;

                        const divError = document.querySelector('.alert_message');

                        if (Object.values(Object.keys(jsonResp))[0] === "Failed")

                        {

                            const textContent = Object.values(Object.values(jsonResp)[0])[0];

                            toggleClass(divError, "show");

                            divError.innerHTML = textContent;

                            inscriptionButton.classList.remove("can_click");

                            error = true;

                        }

                        if (!error)

                        {

                            const mailContainer = document.querySelector('.mailcontainer');

                            toggleClass(divError, "hide");
                            nextForm(secondForm, thirdForm);
                            mailContainer.innerHTML = Object.values(jsonResp)[1];

                        }

                    }

                )

                .catch(error =>

                    {

                        console.error(error);

                    }

                );

        } else if (e.target === formTwoContent && validationButton.classList.contains("can_click"))

        {

            const formData = new FormData(formTwoContent);

            fetch("../confirmation.php",

                    {
                        method: "POST",
                        body: formData

                    })

                .then(response =>

                    {

                        return response.json();

                    }

                )
                .then(jsonResp =>

                    {

                        let error = false;

                        const divError = document.querySelector('.alert_message');

                        if (Object.values(Object.keys(jsonResp))[0] === "Failed")

                        {

                            const textContent = Object.values(Object.values(jsonResp)[0])[0];

                            toggleClass(divError, "show");

                            divError.innerHTML = textContent;

                            validationButton.classList.remove("can_click");

                            error = true;

                        }

                        if (!error)

                        {

                            toggleClass(divError, "hide");

                        }

                    }

                )

                .catch(error =>

                    {

                        console.error(error);

                    }

                );

        }

    })
$(document).ready(function () {

    let count = 0;
    let translate = 1400;
    $(".arrow_next_container").click(function () {
        count = count + 1;
        let scroll = translate * count;
        console.log(count)
        $(".video_content").animate({
            scrollLeft: scroll
        }, "1s");
        console.log(scroll)
        $(".arrow_prev_container").click(function () {
            count = count - 1;
            $(".video_content").animate({
                scrollLeft: scroll - 1400
            }, "1s");
            console.log(count)

        })
    })


    // $(".menu_icon").click(function(){
    //     $(".menu_container").toggleClass("menu_container_click menu_container_click2");
    // })

    
    
    // Profil page -> switch identified and realisation container
    $(".realisation_number_content_title2").click(function () {
        //     let parentReal = $(".realisation_container").parent();
        //     let parentIden = $(".identified_container").parent();
        //     // $(parentReal).delay(500).fadeOut();
        //     $(".realisation_container").addClass("realisation_container_click").removeClass("realisation_container_click2");
        //     // $(parentIden).delay(100).fadeIn(500);
        //     $(".identified_container").addClass("identified_container_click").removeClass("identified_container_click2");
        // })

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
    
    
//     $(window).resize(function () {
//         if ($(".realisation_number_content_line").hasClass("realisation_number_content_line2")) {
//             $(".all_realisation_container").animate({
//                 scrollLeft: 2000
//             },"1s");
//         }
// })
    
    
    //     let parentReal = $(".realisation_container").parent();
    //     let parentIden = $(".identified_container").parent();
    //     // $(parentIden).fadeOut(500);
    //     $(".identified_container").addClass("identified_container_click2").removeClass("identified_container_click");
    //     // $(parentReal).delay(100).fadeIn(500);
    //     $(".realisation_container").addClass("realisation_container_click2").removeClass("realisation_container_click");

    // $(".realisation_number_content_title2").click(function(){
    //     let parentReal = $(".realisation_container").parent();
    //     let parentIden = $(".identified_container").parent();
    //     $(parentReal).toggle({ direction: "right" }, 1000);
    //     $(parentIden).delay(100).show({ direction: "left" }, 1000);
    // })

    // $(".realisation_number_content_title1").click(function(){
    //     let parentReal = $(".realisation_container").parent();
    //     let parentIden = $(".identified_container").parent();
    //     $(parentReal).show("blind", { direction: "right" }, 1000);
    //     $(parentIden).delay(100).hide("blind", { direction: "right" }, 1000);
    // })

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

    // Synopsis title
    $(".synopsis_title_container").hover(function () {
        $(this).find(".see_more").toggleClass("see_more_hover");
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

        // Video mouseout
        $(this).mouseout(function () {

            // If the mouse is over the user_container
            if ($(videoParent).find(".user_container:hover").length != 0) {
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
    })

    // Film hover
    $(".film").hover(function toggleControls() {
        this.setAttribute("controls", "controls");

        $(this).mouseout(function () {
            this.removeAttribute("controls", "controls");
        })
    })

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


    // Btn "J'aime" animation click
    $('.pop_corn_icon').on({
        'click': function () {
            var src = ($(this).attr('src') === 'public/img/pop_corn_icon.svg') ?
                'public/img/pop_corn.png' :
                'public/img/pop_corn_icon.svg';
            $(this).attr('src', src);
        }
    });




    // Modify icon animation hover
    $(".modify_icon").hover(function () {
        $(this).attr('src', 'public/img/modify_icon_hover.svg');
        $(this).hide()
    })
    $(".modify_icon").mouseout(function () {
        $(this).attr('src', 'public/img/modify_icon.svg');
    })


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