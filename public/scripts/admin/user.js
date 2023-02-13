
let userrole      = select('.moderate_box select[name = "role"]');
let fullname      = select('.moderate_box input[name = "fullname"]');
let useremail     = select('.moderate_box input[name = "email"]');
let userage       = select('.moderate_box input[name = "age"]');
let userbooks     = select('.moderate_box input[name = "books"]');
let userviews     = select('.moderate_box input[name = "views"]');
let userimage     = select('.moderate_box input[name = "image"]');
let image_display     = select('.moderate_box img');
let delete_btn     = select('.moderate_box button.del');
let update_btn     = select('.moderate_box button.update');

let selected_id   = null;
let selected_self = null;

function moderate(name, email, age, books, views, role, id, image, self) {

    
    selected_id   = id;
    selected_self = self;
    
    userrole.value    = role;
    console.log(role);

    fullname.value    = name;
    useremail.value   = email;
    userage.value     = age;
    userbooks.value   = books;
    userviews.value   = views;

    image_display.src = `/images/user_images/${image}`;

    update_btn.setAttribute('onclick', 'update_prompt()');
    delete_btn.setAttribute('onclick', 'delete_prompt()');


    
    activate_itm('.user_moderate_case');

}

function update_prompt() {
    alert({
        type:           'warning',
        message:        'You are about to update this user\'s details, are you sure you want to do this?',
        first_btn:      'Update',
        first_btn_str:  `update()`,
    });
}

function update() {
    alert({
        type: 'loading',
        message: 'Updating..'
    });

    let collection_data = new FormData();
    let image = userimage.files[0];
    let role = userrole.value;

    if(typeof(image) != 'undefined')
    collection_data.append('image', image);

    collection_data.append('id', selected_id);
    collection_data.append('role', role);


    set_ajax();

    $.ajax({
        method: 'POST',
        url: '/update_user',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: collection_data,
        success: (data) => {
            console.log(data)
            alert({
                type: 'success',
                message: 'User Updated'
            });

            selected_self.setAttribute('onclick', `onclick = 'moderate("${fullname}", "${useremail}", ${userage}, ${userbooks}, ${userviews}, "${data.role}", ${selected_id}, "${data.image}", this)`);

            selected_self.parentNode.parentNode.querySelector('img').src = `/images/user_images/${data.image}`;
        }
    })
}


function delete_prompt() {
    alert({
        type:           'warning',
        message:        'You are about to delete this User, are you sure you want to do this?',
        first_btn:      'Delete',
        first_btn_str:  `delete_()`,
    })
}


function delete_() {
    alert({
        'type': 'loading',
        'message': 'Deleting...'
    });

    $.ajax({
        method: 'POST',
        url: '/delete_user',
        data: {id: selected_id},
        success: (data) => {

            console.log(data);

            if(data.status == 'success')
            {
                selected_self.parentNode.parentNode.remove();
                
                alert({
                    type: 'success',
                    message: 'Deleted'
                });

                deactivate_itm('.user_moderate_case');
            }

            
        }
    });
}


let searcher = $('[name = "search"]');
let filter   = $('[name = "filter"]');

let add_btn = $('.admin-search .add-new');

// add_btn.on('click', create_prompt);

searcher.on('keyup', user_search);
filter.on('change', user_search);

function user_search() {

    deactivate_itm('.loading-box', 'errorr');
    activate_itm('.loading-box');
    activate_itm('.loading');

    select('.row-items').innerHTML = '';

    search(searcher.val(), filter.val(), '/user_search', (data)=> {

        console.log(data);

        deactivate_itm('.loading-box');
        deactivate_itm('.loading');

        if(data.length == 0)  {
            activate_itm('.loading-box');
            activate_itm('.loading-box', 'errorr');
        }
        
        select('.row-items').innerHTML = data;

        
    })
}








function clear_modal() {

    select('.moderate_box input[name = "role"]');
    select('.moderate_box input[name = "fullname"]');
    select('.moderate_box input[name = "email"]');
    select('.moderate_box input[name = "age"]');
    select('.moderate_box input[name = "books"]');
    select('.moderate_box input[name = "views"]');

}