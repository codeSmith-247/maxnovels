
let current_column = null;

function moderate(category, image, id, self) {

    current_column = self;

    alert_input({
        label:          'Category',
        input:          category,
        image:          `/images/category_images/${image}`,
        first_btn:      `delete_prompt(${id})`,
        second_btn:     `update_prompt(${id})`,
    });
}

function create_prompt() {

    
    alert_input({
        label:          'New Category',
        input:          '',
        second_btn:     `create()`,
    });
    
    select('.alert-content.edit button.second').setAttribute('onclick', 'create()');
    select('.alert-content.edit button.second').innerHTML = 'Create';
    select('.alert-case.edit button.del').style.display = 'none';

}

function create() {
    alert({
        type: 'loading',
        message: 'Creating..'
    });

    let collection_data = new FormData();
    let image = select('.alert-case.edit [name = "image"]').files[0];
    let name = select('.alert-case.edit [name = "input"]').value;

    if(typeof(image) != 'undefined')
    collection_data.append('image', image);

    else {
        alert({
            type: 'error',
            message: 'You need to upload an image for this category'
        });

        return false;
    }

    if(name == '') {
        alert({
            type: 'error',
            message: 'You need to provide a name for this category'
        });

        return false;
    }

    collection_data.append('name', name);


    set_ajax();

    $.ajax({
        method: 'POST',
        url: '/create_category',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: collection_data,
        success: (data) => {

            if(data.status == 'exists') {

                alert({
                    type: 'error',
                    message: 'A category with this name already exists.'
                });

            }
            else {

                console.log(data);

                select('.row-items').insertAdjacentHTML('afterbegin', 
                    data
                );
    
                alert({
                    type: 'success',
                    message: 'Created'
                });

                alert_input_resert()

            }

        }
    });
}

function update_prompt(id) {
    alert({
        type:           'warning',
        message:        'You are about to update this category, are you sure you want to do this?',
        first_btn:      'Update',
        first_btn_str:  `update(${id})`,
    })
}

function delete_prompt(id) {
    alert({
        type:           'warning',
        message:        'You are about to delete this category, are you sure this is what you want to do?',
        first_btn:      'Delete',
        first_btn_str:  `delete_(${id})`,
    })
}

function update(id) {

    alert({
        type: 'loading',
        message: 'Updating..'
    });

    let collection_data = new FormData();
    let image = select('.alert-case.edit [name = "image"]').files[0];
    let name = select('.alert-case.edit [name = "input"]').value;

    if(typeof(image) != 'undefined')
    collection_data.append('image', image);

    collection_data.append('id', id);
    collection_data.append('name', name);


    set_ajax();

    $.ajax({
        method: 'POST',
        url: '/update_category',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: collection_data,
        success: (data) => {

            if(data.status == 'success') {
                if(typeof(image) != 'undefined') {
                    let url = URL.createObjectURL(image);
                    current_column.parentNode.parentNode.querySelector('.image img').src = url;
                }

                current_column.parentNode.parentNode.querySelector('.row-value.name').innerHTML = data.name;

    
                alert({
                    type: 'success',
                    message: 'Updated'
                });

            }
            else if(data.status == 'exists') {

                alert({
                    type: 'error',
                    message: 'A category with this name already exists.'
                });

            }

            current_column.setAttribute('onclick', `moderate("${data.name}", "${data.image}", ${id}, this);`);


        }
    });

}

function delete_(id) {

    alert({
        'type': 'loading',
        'message': 'Deleting...'
    });

    $.ajax({
        method: 'POST',
        url: '/delete_category',
        data: {id: id},
        success: (data) => {

            console.log(data);

            if(data.status == 'success')
            {
                current_column.parentNode.parentNode.remove();
                
                alert({
                    type: 'success',
                    message: 'Deleted'
                });

                alert_input_resert();
            }

            
        }
    });
}


let searcher = $('[name = "search"]');
let filter = $('[name = "filter"]');

let add_btn = $('.admin-search .add-new');

add_btn.on('click', create_prompt);

searcher.on('keyup', category_search);
filter.on('change', category_search);

function category_search() {

    deactivate_itm('.loading-box', 'errorr');
    activate_itm('.loading-box');
    activate_itm('.loading');

    select('.row-items').innerHTML = '';

    search(searcher.val(), filter.val(), '/admin_category_search', (data)=> {

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