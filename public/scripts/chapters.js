let list = select('.chapters');
let sortable = new Sortable(list, {
    animation: 400,
});

let search_ = $('input[name = "search"]');

search_.on('keyup', search);
$('.search-box button').on('click', search);


let searched_value = '';

function search() {

    $('.chapters').html('');
    activate_itm('.loading-box');

    searched_value = search_.val();

    $.ajax({
        method: 'GET',
        url: '/search_chapters',
        data: {
            'book_id' : $('meta[name="book_id"]').attr('content'),
            'search'  : searched_value,
        },
        success: (data) => {

            
            if(data.length > 0)
            deactivate_itm('.loading-box');
            else
            activate_itm('.loading-box', 'errorr');

            $('.chapters').html(data);
        }
    })

}

$('.chapters').on('change', reorder);

function reorder() {
    let order_array = [];

    selectAll('.chapter').forEach( chapter => {
        order_array.push(chapter.getAttribute('order'));
    });

    set_ajax();

    $.ajax({
        method: 'POST',
        url: '/reorder_chapter',
        data: {
            'book_id' : $('meta[name="book_id"]').attr('content'),
            'order'   : order_array,
            'search'  : searched_value
        }
    })
}

function publish_prompt() {

    set_ajax();
    
    alert({
        type: 'warning',
        message: 'You are about to publish all chapters, chapters with small contents would not be published.',
        first_btn: 'Publish All',
    });

    select('.alert-case.alert button.first').setAttribute('onclick', 'publish_all();');
}

function publish_all() {

    alert({
        type: 'darkmode',
        message: 'Publishing',
    });

    set_ajax();

    $.ajax({
        method : 'POST',
        url    : '/publish_chapters',
        data   : {
            'book_id'    : $('meta[name = "book_id"]').attr('content'),
        },
        success: (data) => {
            if(data.status = 'success') {
                alert({
                    type: 'success',
                    message: 'All chapters are published'
                });
            }
        }
    })
}