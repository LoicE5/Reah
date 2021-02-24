$(document).ready(function () {
    $(".settings_menu_option_profile").addClass("settings_menu_option_click")


    $(".settings_menu_option").click(function(){
        let number = $(this).attr("number");
        console.log(number)
        let translate = number*60;
        console.log(translate)
        $(".settings_menu_option").removeClass("settings_menu_option_click")

        $(this).addClass("settings_menu_option_click");
        $(".settings_menu_line").css({
            "transform":`translate(296px, ${translate}px)`,
            "transition":"transform 0.2s ease"
        })

        $(`.settings_container`).hide()
        $(`.settings_container[number='${number}']`).show();    
    })

    $(".notification_btn").click(function(){
        let notificationBtn = $(this).children();
        $(this).children().attr("class") == "notification_btn_click" ?  $(notificationBtn).addClass("notification_btn_click2").removeClass("notification_btn_click") : $(notificationBtn).addClass("notification_btn_click").removeClass("notification_btn_click2");
     
    })

    $(window).resize(function(){
        if ($(window).width() <= 950){
            $(".settings_menu").addClass("settings_menu_close").removeClass("settings_menu_open");
            $(".settings_container").click(function(){
                $(".settings_menu").addClass("settings_menu_close").removeClass("settings_menu_open");
            })
        } else{
            $(".settings_menu").addClass("settings_menu_open").removeClass("settings_menu_close");
            $(".settings_container").click(function(){
                $(".settings_menu").addClass("settings_menu_open").removeClass("settings_menu_close");
                
            })
        }
    })

    $(".menu_btn").click(function(){
        // $(".settings_menu").addClass("settings_menu_open")
        $(".settings_menu").hasClass("settings_menu_open") ?  $(".settings_menu").addClass("settings_menu_close").removeClass("settings_menu_open") : $(".settings_menu").addClass("settings_menu_open").removeClass("settings_menu_close");

    })

})