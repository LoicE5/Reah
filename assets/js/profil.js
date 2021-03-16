// Subcribe button
function subscribe(e) {
    if ($(e).text() == "S'abonner") {
        $(e).text("Abonné(e)")
        $(e).addClass("subscribe_btn_click");
    } else {
        $(".unfollow_container").fadeIn(500).addClass("film_container_open flex").removeClass("film_container_close");
        $(".unfollow_dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    
    $(".unfollow_dark_filter,.unfollow_close_icon, ,.unfollow_btn").click(function () {
        $(".unfollow_container").fadeOut().addClass("film_container_close").removeClass("film_container_open flex");
        $(".unfollow_dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })
    }
}

// Delete subcriber button
function deleteSubscriber() {
  
        $(".delete_subscriber_container").fadeIn(500).addClass("film_container_open flex").removeClass("film_container_close");
        $(".unfollow_dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    
    $(".unfollow_dark_filter,.unfollow_close_icon, ,.unfollow_btn").click(function () {
        $(".delete_subscriber_container").fadeOut().addClass("film_container_close").removeClass("film_container_open flex");
        $(".unfollow_dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })
}

$(document).ready(function () {


    // Modify icon animation hover
    $(".modify_icon").hover(function () {
        $(this).attr('src', 'sources/img/modify_icon_hover.svg');
        // $(this).hide()
    })
    $(".modify_icon").mouseout(function () {
        $(this).attr('src', 'sources/img/modify_icon.svg');
    })



    $(".unfollow_btn").click(function(){
        $(".subscribe_btn").text("S'abonner").removeClass("subcribe_btn_click");
        $(".unfollow_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })

    // Pop up unfollow 
    $(".subscription_user_btn").click(function(){
        $(".unfollow_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
            $(".unfollow_dark_filter").addClass("show fixed");
            $(".main_content").addClass("scroll_none")
        
        $(".unfollow_dark_filter,.unfollow_close_icon").click(function () {
            $(".unfollow_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
            $(".unfollow_dark_filter").removeClass("show");
            $(".main_content").removeClass("scroll_none")
        })
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


    // Line position left and width
    let realisationLenght = $(".realisation_number_content_title1").width();
    let realisationLeft = $(".realisation_number_content_title1").position();
    
    $(".realisation_number_content_line").css({

        "width": `${realisationLenght}px`,
        "transform": `translate(${realisationLeft.left}px)`,
        "transition": "0.5s ease",
    });

    // Realisations number title + underline animation hover + click
    $(".realisation_number_content_title1").addClass("category_title_click");

    $(".realisation_number_content_title").hover(function () {
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
                    "color": "var(--text-grey)"
                });
            }
        })
    })

    $(".realisation_number_content_title").click(function () {
        let number = $(this).attr("number");
        console.log("number");
        $(".realisation_number_content_title").removeClass("category_title_click");
        $(".realisation_number_content_title" + number).css({
            "color": "var(--text-grey)"
        });

        $(this).addClass("category_title_click");

        let realisationLenght = $(".realisation_number_content_title1").width();
        let identifiedLenght = $(".realisation_number_content_title2").width();
        let realisationLeft = $(".realisation_number_content_title1").position();
        let identifiedLeft = $(".realisation_number_content_title2").position();

        if (number == "1") {

            $(".realisation_number_content_line").css({

                "width": `${identifiedLenght}px`,
                "transform": `translate(${identifiedLeft.left}px)`,
                "transition": "0.5s ease",
            });
            console.log($(".subscription_line").width());

        } else if (number == "2") {
            $(".realisation_number_content_line").css({

                "width": `${realisationLenght}px`,
                "transform": `translate(${realisationLeft.left}px)`,
                "transition": "0.5s ease",
            });
        }

    })

    // Pop up to modify profile
    $(".modify_icon").click(function () {
        $(".modify_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
        $(".dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".dark_filter,.modify_close_icon").click(function () {
        $(".modify_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })

    // Close icon animation hover
    $(".modify_close_icon").hover(function () {
        $(this).attr('src', 'sources/img/close_icon_hover.svg');
    })
    $(".modify_close_icon").mouseout(function () {
        $(this).attr('src', 'sources/img/close_icon.svg');
    })


    // Subscription pop up

    $(".profile_subscription_content").click(function () {
        $(".subscription_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
        $(".dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")

        if ($(this).attr("number") == "1") {

            // Subscriber section translate
            $(".subscriber_section,.subscription_section").addClass("subscriber_click2").removeClass("subscriber_click");
            // Line position and width
            let subscriberLeft = $(".subscriber_title").position();
            let subscriberLenght = $(".subscriber_title").width();
            $(".subscription_line").css({
                "width": `${subscriberLenght}px`,
                "transform": `translate(${subscriberLeft.left}px)`
            })
        } else {
            // Subscription section translate
            $(".subscriber_section,.subscription_section").addClass("subscriber_click").removeClass("subscriber_click2");
            // Line position and width
            let subscriptionLeft = $(".subscription_title").position();
            let subscriptionLenght = $(".subscription_title").width();
            $(".subscription_line").css({
                "width": `${subscriptionLenght}px`,
                "transform": `translate(${subscriptionLeft.left}px)`
            })
        }
    })
    $(".dark_filter,.close_icon").click(function () {
        $(".subscription_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })

    // Subscription / subscriber translate
    $(".subscription_title").click(function () {
        $(".subscriber_section,.subscription_section").addClass("subscriber_click").removeClass("subscriber_click2");
    })

    $(".subscriber_title").click(function () {
        $(".subscriber_section,.subscription_section").addClass("subscriber_click2").removeClass("subscriber_click");
    })

    // Subscription title color
    $(".subscriber_title").addClass("category_title_click");

    $(".subscriber_title,.subscription_title").hover(function () {
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
                    "color": "var(--text-grey)"
                });
            }
        })
    })

    // Subscription title click + line animation

    $(".subscriber_title,.subscription_title").click(function () {
        let number = $(this).attr("number");
        $(".subscriber_title,.subscription_title").removeClass("category_title_click");
        $(".subscriber_title,.subscription_title" + number).css({
            "color": "var(--text-grey)"
        });

        $(this).addClass("category_title_click");

        let subscriptionLenght = $(".subscription_title").width();
        let subscriberLenght = $(".subscriber_title").width();
        let subscriptionLeft = $(".subscription_title").position();
        let subscriberLeft = $(".subscriber_title").position();

        if (number == "1") {

            $(".subscription_line").css({

                "width": `${subscriptionLenght}px`,
                "transform": `translate(${subscriptionLeft.left}px)`,
                "transition": "0.4s ease",
            });
            console.log($(".subscription_line").width());

        } else if (number == "2") {
            $(".subscription_line").css({

                "width": `${subscriberLenght}px`,
                "transform": `translate(${subscriberLeft.left}px)`,
                "transition": "0.4s ease",
            });
        }
    })
})