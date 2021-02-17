const body = document.querySelector('body');
const form = document.querySelector('.form_container');
const button = document.querySelector('.btn_connexion');
const input = document.querySelectorAll('.input_connexion');
const pswdInput = document.querySelector('.input_mdp');
const pswdConfirmInput = document.querySelector('.mdp_confirm');

body.addEventListener('change', (e) => 

{

    verifForm(e.target, "input_connexion", button, input, null, null, null, "password_verif", pswdInput, pswdConfirmInput);

})