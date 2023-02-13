

function alert(obj) {

    alert_reset();

    let text = select('.alert-case.alert .alert-content .text');

    if(obj.message != null) {
        text.innerHTML = obj.message;
        activate_itm('.alert-case.alert .alert-content .text');
    }

    if(obj.type != null) {
        
        activate_itm('.alert-icon');
        

        if(obj.type == 'loading') {
            if(select('body').classList.contains('darkmode')) {
                activate_itm('.alert-icon .darkmode.loading');
            }
            else 
            activate_itm('.alert-icon .lightmode.loading');
        }

        else 

        activate_itm(`.alert-icon .${obj.type}`);

    }

    if(obj.first_btn != null) {
        activate_itm('.alert-case.alert button.first');
        select('.alert-case.alert button.first').innerHTML = obj.first_btn;
        
        if(obj.first_btn_str != null)
        select('.alert-case.alert button.first').setAttribute('onclick', obj.first_btn_str)
    }

    if(obj.second_btn != null) {
        activate_itm('.alert-case.alert button.second');
        select('.alert-case.alert button.second').innerHTML = obj.second_btn;

        if(obj.second_btn_str != null)
        select('.alert-case.alert button.second').setAttribute('onclick', obj.second_btn_str)
    }

    activate_itm('.alert-case.alert');

}

function alert_input(obj) {

    alert_input_resert();

    if(obj.label != null) {
        selectAll('.alert-case.edit .label').forEach( label => {
            label.innerHTML = obj.label;
        })
    }

    if(obj.select != null) {
        activate_itm('.alert-content.edit .input.select');
        select('.alert-content.edit select').setAttribute('value', obj.select);
    }

    if(obj.input != null) {
        activate_itm('.alert-content.edit .input.text');
        select('.alert-content.edit input[name = "input"]').setAttribute('value', obj.input);
        select('.alert-content.edit input[name = "input"]').value = obj.input;
    }

    if(obj.image != null) {
        select('.image-box img').src = obj.image;
    }

    if(obj.first_btn != null) {
        select('.alert-content.edit button.del').setAttribute('onclick', obj.first_btn);
    }

    if(obj.second_btn != null) {
        select('.alert-content.edit button.second').setAttribute('onclick', obj.second_btn);
    }

    activate_itm('.alert-case.edit');
}

function alert_reset() {
    deactivate_itm('.alert-case.alert');
    deactivate_itm('.alert-case.alert .alert-content .text');

    deactivate_itm('.alert-case.alert button.first');
    select('.alert-case.alert button.first').setAttribute('onclick', '');

    deactivate_itm('.alert-case.alert button.second');
    select('.alert-case.alert button.second').setAttribute('onclick', '');

    deactivate_itm('.alert-icon');

    selectAll('.alert-icon img').forEach( image => {
        image.classList.remove('active');
    });
}

function alert_input_resert() {
    deactivate_itm('.alert-case.edit')
    deactivate_itm('.alert-content.edit select');
    deactivate_itm('.alert-content.edit input');

    select('.alert-content.edit input').value = '';
    select('.alert-content.edit input[name = "input"]').value = '';

    select('.alert-content.edit button.del').setAttribute('onclick', '');
    select('.alert-case.edit button.del').setAttribute('onclick', '');

    select('.alert-case.edit button.del').style.display = 'block';
    select('.alert-content.edit button.second').innerHTML = 'Update';


    select('.alert-content.edit button.second').setAttribute('onclick', '');
    select('.alert-case.edit button.second').setAttribute('onclick', '');

    select('.image-box img').src = '/images/cover.webp';

}



function insert_alert_image(self) {

    alert({
        type: 'loading',
        message: 'uploading'
    });

    let images = self.target.files;

    if(images.length <= 0) return false;

    let url = URL.createObjectURL(images[0]);
    select('.image-box img').src = url;

    alert_reset();

}

function insert_alert_image_2(self) {

    alert({
        type: 'loading',
        message: 'uploading'
    });

    let images = self.target.files;

    if(images.length <= 0) return false;

    let url = URL.createObjectURL(images[0]);
    select('.user_image_box img').src = url;

    alert_reset();

}

