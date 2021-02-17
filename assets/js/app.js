
function toggleClass(element, display)

{

    switch (display)

    {

        case 'hide':

            element.classList.remove("show");
            element.classList.remove("flex");

            return element.classList.add("hide");

        case 'show':

            element.classList.remove("hide");
            element.classList.remove("flex");

            return element.classList.add("show");

        case 'flex':

            element.classList.remove("show");
            element.classList.remove("hide");

            return element.classList.add("flex");


    }

}

function canChangeForm(error, button, action = null, actualForm, secondForm)

{

    if (!error)

    {

       button.classList.add('can_click');

        if(action !== null)
        button.addEventListener('click', () => action(actualForm, secondForm));

       return error;

    }

    else

    {

        if(action !== null)
        button.removeEventListener('click', () => action(actualForm, secondForm));

        return error;

    }


}

function verifForm(element, selector, button, input, action, actualForm = null, secondForm = null, type = null, pswdInput = null, pswdVerifInput = null)

{

    if(element.classList.contains(selector))

    {

        button.classList.remove('can_click');

        let error = false;

        input.forEach(e =>

            {

                if(e.validity.valid === false)

                {

                    error = true;

                }

            })

        if(type === "password_verif")

        {


                if(checkPassword(pswdInput))

                {

                    error = true;

                }

                if(pswdInput.value !== pswdVerifInput.value)

                {

                    error = true;

                }

        }

        if(selector === "first_form")
            inscriptionButton.classList.add("can_click");

       canChangeForm(error, button, action, actualForm, secondForm);
       return error;

    }

}

function checkPassword(pswdInput)

{

    let error = false;

    const regExp = /(?=.*[A-Za-z])(?=.*[A-Z])[A-Za-z\d@$!%*#?&/\\]{8,}$/;

    if(!regExp.test(pswdInput.value))

    {

         error = true;

    }

    return error;

}

function nextForm(actualForm, secondForm)

{

    actualForm.classList.remove("translate_right");
    actualForm.classList.add("translate_left");

    $(actualForm).fadeOut(150);
     $(secondForm).fadeIn(600);
     $(secondForm).css({
         "display": "flex"
     });
     $(secondForm).removeClass("translate_right2");
     $(secondForm).addClass("translate_left2");


}

function previousForm(actualForm, secondForm)

{

    $(secondForm).removeClass("translate_left");
    $(secondForm).addClass("translate_right");
    $(secondForm).fadeIn(600);
    $(actualForm).fadeOut(150);
    $(actualForm).removeClass("translate_left2 translate_right");
    $(actualForm).addClass("translate_right2");
    $(secondForm).css({
        "display": "flex"
    });

}

// Animation eye password

$(".icon_eye").mousedown(function(){
    $(this).addClass("icon_eye_open")
})
$(".icon_eye").mouseup(function(){
    $(this).removeClass("icon_eye_open")
})
$(".input_mdp").click(function(){
    $(".restriction").addClass("restriction_translate")
    $(".restriction_container").addClass("restriction_container_border")
})

// Voir le mdp
document.querySelector('#eye').addEventListener("mousedown",  () => 

{

    document.querySelector('#input_mdp').setAttribute('type', 'text');
    document.querySelector('#input_mdp_validation').setAttribute('type', 'text');

});

document.querySelector('#eye').addEventListener("mouseup",  () => 

{

    document.querySelector('#input_mdp').setAttribute('type', 'password');
    document.querySelector('#input_mdp_validation').setAttribute('type', 'password');

});

