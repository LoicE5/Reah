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
        $(`.settings_container[number='${number}']`).show()
    })
})