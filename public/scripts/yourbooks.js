

let search_ = $('input[name = "search"]');

search_.on('keyup', search);
$('.search-box button').on('click', search);


let searched_value = '';

function search() {

    $('.grid-box').html('');

    activate_itm('.loading-box');
    activate_itm('.loading');

    searched_value = search_.val();

    $.ajax({
        method: 'GET',
        url: '/yourbooks_search',
        data: {
            'filter' : '',
            'search'  : searched_value,
        },
        success: (data) => {

            console.log(data);
            
            if(data.length > 0)
            deactivate_itm('.loading-box');
            else
            activate_itm('.loading-box', 'errorr');

            $('.grid-box').html(data);
        }
    })

}

function update_image(self) {

    alert({
        type: 'loading',
        message: 'uploading'
    });

    let images = self.target.files;

    if(images.length <= 0) return false;

    let url = URL.createObjectURL(images[0]);

    set_ajax();

    let collection_data = new FormData();
    let image = select('.avatar [name = "image"]').files[0];

    if(typeof(image) != 'undefined') {

        collection_data.append('image', image);
        collection_data.append('id', user_id);
    }

    else {
        alert({
            type: 'error',
            message: 'Please select an image and try again',
        });

        return false;
    }


    set_ajax();

    $.ajax({
        method: 'POST',
        url: '/update_avatar',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: collection_data,
        success: (data) => {

            if(data.status == 'success') {

                select('.avatar img').src = url;
                alert_reset();
            }

            else {
                alert({
                    'type': 'error',
                    'message': 'Unable to update user image'
                });
            }

        }
    });


}

function delete_prompt(book_title) {

    book_title = book_title.getAttribute('title');

    alert({
        first_btn: 'Delete',
        first_btn_str: `delete_("${book_title}")`,
        message: `You are about to delete ${book_title} book, are you sure this is what you want to do?`,
        type: 'warning',
    })
}

function delete_(book_title) {
    set_ajax();

    alert({
        type: 'loading'
    });

    $.ajax({
        method: 'POST',
        url: '/delete_book',
        data: {book: book_title},
        success: (data) => {
            console.log(data);

            if(data.status == 'success') {
                select(`[main_title = "${book_title}"]`).remove();
                alert({
                    type: 'success',
                    message: 'book deleted'
                });
            }
            else {
                alert({
                    type: 'error',
                    message: 'unable to delete book, please try again later'
                });
            }
        }
    })
}

function chapters(self) {
    location.href = `/chapters/${self.getAttribute('title')}`;
}