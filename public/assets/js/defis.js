$(document).ready(function(){

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

    $(".add_defi_btn").click(function () {
        $(".add_defi_container").fadeIn(500).addClass("film_container_open").removeClass("film_container_close");
        $(".dark_filter").addClass("show fixed");
        $(".main_content").addClass("scroll_none")
    })
    $(".dark_filter,.close_icon").click(function () {
        $(".add_defi_container").fadeOut().addClass("film_container_close").removeClass("film_container_open");
        $(".delete_dark_filter").removeClass("show");
        $(".main_content").removeClass("scroll_none")
    })
})