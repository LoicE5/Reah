const body = document.querySelector('body');
const form = document.querySelector('.form_container');
const button = document.querySelector('.btn_connexion');
const input = document.querySelectorAll('.input_connexion');


body.addEventListener('change', (e) => 

{

    verifForm(e.target, "input_connexion", button, input, null);

})