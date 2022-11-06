function activate_log_in() {
    activate_itm('.login.modal_box');
}

function deactivate_log_in() {
    deactivate_itm('.login.modal_box');
}

select('.login .modal-close-btn').addEventListener('click', deactivate_log_in);
select('.nav_button.login_link').addEventListener('click',  activate_log_in);