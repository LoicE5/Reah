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
})