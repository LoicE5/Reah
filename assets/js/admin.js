$(document).ready(function () {


    const title1Lenght = $(".category_title1").width();
    const title2Lenght = $(".category_title2").width();
    const title3Lenght = $(".category_title3").width();
    const title4Lenght = $(".category_title4").width();
    const title1Left = $(".category_title1").position();
    const title2Left = $(".category_title2").position();
    const title3Left = $(".category_title3").position();
    const title4Left = $(".category_title4").position();

    const titlePosition = $("#title2").offset().top - 100;
    const titlePosition2 = $("#title3").offset().top - 100;
    const titlePosition3 = $("#title4").offset().top - 100;

    // Category title
    $(".category_title,.category_list_category").click(function () {

        const number = $(this).attr("number");
        const number1 = $(this).attr("number1");
        const number2 = $(this).attr("number2");
        const number3 = $(this).attr("number3");
        console.log("number");
        // $(".category_title").removeClass("category_title_click");
        $(".category_title" + number1 + ",.category_title" + number2 + ",.category_title" + number3).css({
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
        } else if (number == "4") {
            $("html, body").animate({
                scrollTop: titlePosition3
            }, "1s");
            $(".underline").css({
                "width": `${title4Lenght}px`,
                "transform": `translate(${title4Left.left}px)`,
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
        if ($(document).scrollTop() >= (titlePosition3 - 100)) {
            $(".category_title,.category_list_category").removeClass("category_title_click").css({
                "color": "var(--text_grey)",
                "font-weight": "400",
            });
            $(".category_title4,.category_list_category4").addClass("category_title_click").css({
                "color": "var(--text)",
                "font-weight": "bold"
            });
            $(".underline").css({
                "width": `${title4Lenght}px`,
                "transform": `translate(${title4Left.left}px)`,
                "transition": "0.5s ease",
            });
        }

    })

})