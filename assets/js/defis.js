$(document).ready(function(){

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



    // Temps restant
        // var launch = new Date();
        // var launch = Date.parse(20, 03, 2021);
        var launch = new Date(2021,03,20,22,28,00);
        console.log(launch.getTime());
        // console.log(launch.getTime());
        setDate();
        function setDate(){
            var now = new Date();
            var s = (launch.getTime() - now.getTime())/1000;
            // var d = s/86400;
            // s('#days').html('<strong>'+d+'</strong>');
         console.log(s)
        //  console.log(now.getTime())

            }
             
         
    // setInterval(setDate,1000);




    let title1Lenght = $(".category_title1").width();
    let title2Lenght = $(".category_title2").width();
    let title1Left = $(".category_title1").position();
    let title2Left = $(".category_title2").position();

    let titlePosition = $("#title2").offset().top - 100;

    // Category title
    $(".category_title,.category_list_category").click(function () {

        let number = $(this).attr("number");
        let number1 = $(this).attr("number1");
        console.log("number");
        // $(".category_title").removeClass("category_title_click");
        $(".category_title" + number1).css({
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
       

    })

    $(".help_icon").hover(function(){
        let message = $(this).next();
        // console.log(message)
        $(message).fadeIn(300);
    })
    $(".help_icon").mouseout(function(){
        $(".help_message").fadeOut(300);

    })

})
