$(document).ready(function () {


    // Arrow click
    $(".arrow_next_container").click(function () {
        let videoPosition = $(".video_container").position().left - 110;
        let translate = $(window).width();
        // console.log(-$(".video_container").position().left)
        let scroll = translate - videoPosition;
        // console.log(translate)
        $(".all_video_container").animate({
            scrollLeft: scroll
        }, "1s");
    })
    $(".arrow_prev_container").click(function () {
        let videoPosition = $(".video_container").position().left - 110;
        let translate = $(window).width();
        // console.log($(".video_container").position().left)
        let scroll2 = -videoPosition - translate;
        // console.log(translate)
        $(".all_video_container").animate({
            scrollLeft: scroll2
        }, "1s");
        // console.log(scroll2)

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

        let windowWidth = $(window).width();
        console.log(windowWidth)

        // $(this).addClass("category_title_click");
        $(`#category${number}`).show();
        $(`#category${number2},#category${number3}`).hide();
        $("html,body").animate({
            scrollTop: 0
        }, "0.2s")
    })

    let windowWidth = $(window).width();

    $(window).resize(function () {
        console.log(windowWidth)
        if (windowWidth >= 450) {
            $(`#category1,#category2,#category3`).css({
                "display": "flex"
            });
        } else {
            $(`#category1`).css({
                "display": "flex"
            });
            $(`#category2,#category3`).hide();
        }
    })



    $('#genre_select').change(function () {
        let genreTitle = $(this).find("option:selected").attr("value");
        let arrayGenre = [];
        const op = document.querySelectorAll("#genre_select option#option_genre");

        // Ajout d'un genre
        $(".input_tag_container_genre").append(`<p class="input_tag_genre" value="${genreTitle}">${genreTitle} X</p>`);

        // Qd on supprime un ge re
        $(".input_tag_genre").click(function () {
            let inputTitle = $(this).attr("value");
            $(this).remove();

            for (let i = 0; i < op.length; i++) {
                (op[i].value == inputTitle || op[i].disabled == false) ?
                op[i].disabled = false: op[i].disabled = true;
            }


            for (let i = 0; i < arrayGenre.length; i++) {
                // console.log(arrayGenre[i])

                if (arrayGenre[i] == inputTitle) {
                    let arraySlice = arrayGenre.splice(i, 1);
                    // console.log(arrayGenre.join(', '));

                }
            }
            if ($('.input_tag_genre').text().length == 0) {
                const op = document.querySelectorAll("#genre_select option#option_genre_selected");
                for (let i = 0; i < op.length; i++) {
                    op[i].selected = true;
                }
            }
            // console.log(arrayGenre)
        })


        for (let i = 0; i < op.length; i++) {
            if (op[i].value == genreTitle || op[i].disabled == true) {
                op[i].disabled = true;
                let arrayPush = arrayGenre.push(op[i].value);

            } else {
                op[i].disabled = false;

            }
        }

        // On insère les genres dans l'input
        // console.log(arrayGenre)
        const genreList = arrayGenre.join(', ');
        // console.log(genreList);

        $("#genre").attr('value', genreList);

        // console.log($("#genre").attr('value'));

    })

    $('#collab_select').change(function () {
        let collabTitle = $(this).find("option:selected").attr("value");
        let arraycollab = [];
        const op = document.querySelectorAll("#collab_select option#option_collab");
        // console.log(user_id);
        // Ajout d'un collab
        $(".input_tag_container_collab").append(`<p class="input_tag_collab" value="${collabTitle}">@${collabTitle} X</p>`);

        // Qd on supprime un collab
        $(".input_tag_collab").click(function () {
            let inputTitle = $(this).attr("value");
            $(this).remove();

            for (let i = 0; i < op.length; i++) {
                (op[i].value == inputTitle || op[i].disabled == false) ?
                op[i].disabled = false: op[i].disabled = true;
            }


            for (let i = 0; i < arraycollab.length; i++) {
                // console.log(arraycollab[i])

                if (arraycollab[i] == inputTitle) {
                    let arraySlice = arraycollab.splice(i, 1);
                    // console.log(arraycollab.join(', '));

                }
            }
            if ($('.input_tag_collab').text().length == 0) {
                const op = document.querySelectorAll("#collab_select option#option_collab_selected");
                for (let i = 0; i < op.length; i++) {
                    op[i].selected = true;
                }
            }
            // console.log(arraycollab)
        })


        for (let i = 0; i < op.length; i++) {
            if (op[i].value == collabTitle || op[i].disabled == true) {
                op[i].disabled = true;
                let user_id = $(op[i]).attr('user_id');
                let arrayPush = arraycollab.push(user_id);

            } else {
                op[i].disabled = false;

            }
        }

        // On insère les collabs dans l'input
        // console.log(arraycollab)
        const collabList = arraycollab.join(', ');
        // console.log(collabList);
        console.log(collabList.split(', '));

        $("#collab").attr('value', collabList);

        // console.log($("#collab").attr('value'));

    })
})