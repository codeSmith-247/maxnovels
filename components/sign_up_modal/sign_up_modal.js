
let start_year = 1900;
let end_year = new Date().getFullYear();

select('div.year').appendChild(year_generator(start_year, end_year));
select('div.day').appendChild(day_generator(01, 31));

function activate_sign_up() {
    activate_itm('.signup.modal_box');
}

function deactivate_sign_up() {
    deactivate_itm('.signup.modal_box');
}

select('.signup .modal-close-btn').addEventListener('click', deactivate_sign_up);
select('.nav_button.signup_link').addEventListener('click',  activate_sign_up);