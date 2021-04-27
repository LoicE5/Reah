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

        // if ($(".accueil").css('display') != 'none') {
            if ($(window).scrollTop() >= windowHeight) {
                // $("body,html").animate({
                //     scrollTop: 0
                // }, '1s')
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
        // }

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


    // Si le fil d'actualité est vide 
    if($('#all_video_container').text().length <= '48'){
        $('#all_video_container').append("<p>Ton fil d'actualité est vide. 😢 Abonne-toi à d'autres utilisateurs !</p>");
    }

    // Si l'user n'a pas d'enregistré
    if($('#saved_container').text().length <= '48'){
        $('#saved_container').append("<p class='void'>Tu n'as enregistré aucun court-métrage.</p>");
    }

 

    // $(".video_poster").hover(function(){
    //     $(this).fadeOut(500);
    // })
    // $(".video_poster").mouseout(function(){
    //     $(this).fadeIn(500);
    // })

})