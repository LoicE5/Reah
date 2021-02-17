const body = document.querySelector('body');
const firstForm = document.querySelector('.form_container');
const secondForm = document.querySelector('.form_container2');
const thirdForm = document.querySelector('.form_container3');
const nextButton = document.querySelector('.btn_next');
const previousButton = document.querySelector('.btn_prev');
const inputMdp = document.querySelector('.input_mdp');
const inputMdpVerif = document.querySelector('.input_mdp_verif');
const inputFirstForm = document.querySelectorAll('.first_form');
const inputSecondForm = document.querySelectorAll('.second_form');
const inputThirdForm = document.querySelectorAll('.third_form');
const iconRestriction = document.querySelector('.icon_restriction');
const restriction = document.querySelector('.restriction');
const restrictionContainer = document.querySelector('.restriction_container');
const previousButton2 = document.querySelector('.btn_prev2');
const inscriptionButton = document.querySelector('.btn_inscription');
const validationButton = document.querySelector('.btn_connexion');
const formOneContent = document.querySelector('#form1');
const formTwoContent = document.querySelector('#form2');



body.addEventListener('click', (e) => {

    // Animation click first arrow
    const line = document.querySelector('.line');
    const line2 = document.querySelector('.line2');

    if (e.target === previousButton || e.target === line)

    {

        previousForm(secondForm, firstForm);

    }

    // Animation click second arrow
    else if (e.target === previousButton2 || e.target === line2)

    {

        previousForm(thirdForm, secondForm);

    }

    // Animation restriction password
    else if (e.target === inputMdp)

    {

        toggleClass(iconRestriction, 'show');
        iconRestriction.classList.add('rotate');
        // toggleClass(restriction, 'show');
        toggleClass(restrictionContainer, 'flex');

    }

})

// Translate des form_container

body.addEventListener('change', (e) =>

    {

        verifForm(e.target, "first_form", nextButton, inputFirstForm, nextForm, firstForm, secondForm);

        verifForm(e.target, "second_form", inscriptionButton, inputSecondForm, null, null, null, "password_verif", inputMdp, inputMdpVerif);

        verifForm(e.target, "third_form", validationButton, inputThirdForm, null, null, null);


    })

body.addEventListener('submit', e =>

    {

        e.preventDefault();

        if (e.target === formOneContent && inscriptionButton.classList.contains("can_click"))

        {

            const formData = new FormData(formOneContent);

            fetch("../register.php",

                    {
                        method: "POST",
                        body: formData

                    })

                .then(response =>

                    {

                        return response.json();

                    }

                )
                .then(jsonResp =>

                    {

                        let error = false;

                        const divError = document.querySelector('.alert_message');

                        if (Object.values(Object.keys(jsonResp))[0] === "Failed")

                        {

                            const textContent = Object.values(Object.values(jsonResp)[0])[0];

                            toggleClass(divError, "show");

                            divError.innerHTML = textContent;

                            inscriptionButton.classList.remove("can_click");

                            error = true;

                        }

                        if (!error)

                        {

                            const mailContainer = document.querySelector('.mailcontainer');

                            toggleClass(divError, "hide");
                            nextForm(secondForm, thirdForm);
                            mailContainer.innerHTML = Object.values(jsonResp)[1];

                        }

                    }

                )

                .catch(error =>

                    {

                        console.error(error);

                    }

                );

        } else if (e.target === formTwoContent && validationButton.classList.contains("can_click"))

        {

            const formData = new FormData(formTwoContent);

            fetch("../confirmation.php",

                    {
                        method: "POST",
                        body: formData

                    })

                .then(response =>

                    {

                        return response.json();

                    }

                )
                .then(jsonResp =>

                    {

                        let error = false;

                        const divError = document.querySelector('.alert_message');

                        if (Object.values(Object.keys(jsonResp))[0] === "Failed")

                        {

                            const textContent = Object.values(Object.values(jsonResp)[0])[0];

                            toggleClass(divError, "show");

                            divError.innerHTML = textContent;

                            validationButton.classList.remove("can_click");

                            error = true;

                        }

                        if (!error)

                        {

                            toggleClass(divError, "hide");

                        }

                    }

                )

                .catch(error =>

                    {

                        console.error(error);

                    }

                );

        }

    })
$(document).ready(function () {

    let count = 0;
    let translate = 1400;
    $(".arrow_next_container").click(function () {
        count = count + 1;
        let scroll = translate * count;
        console.log(count)
        $(".video_content").animate({
            scrollLeft: scroll
        }, "1s");
        console.log(scroll)
        $(".arrow_prev_container").click(function () {
            count = count - 1;
            $(".video_content").animate({
                scrollLeft: scroll - 1400
            }, "1s");
            console.log(count)

        })
    })


    // $(".menu_icon").click(function(){
    //     $(".menu_container").toggleClass("menu_container_click menu_container_click2");
    // })




})