$(document).ready(function(){

    $(".defi_content").hover(function () {
        // let number = $(this).attr("defi");
        // let img = $(this).children(".defi_img");
        if ($('.defi_title:hover').length == 0 || $('.defi_content:hover').length == 0) {
            $(this).removeClass("defi_img_hover").addClass("defi_img_mouseout");
            // $(".defi" + number + "_title").removeClass("defi_title_hover").addClass("defi_title_mouseout");
        }
        if ($('.defi_title:hover').length != 0 || $('.defi_content:hover').length != 0) {
            $(this).addClass("defi_img_hover").removeClass("defi_img_mouseout");
            // $(".defi" + number + "_title").addClass("defi_title_hover").removeClass("defi_title_mouseout");
        }
        
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


})

