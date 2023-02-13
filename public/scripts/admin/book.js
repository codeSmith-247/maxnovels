

function moderate(book_title) {
    alert({
        first_btn: "Delete",
        first_btn_str: `delete_prompt("${book_title}")`,
        second_btn: "Edit",
        second_btn_str: `location.href = "/details/${book_title}"`,
    })
}

function delete_prompt(book_title) {
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
                select(`[title = "${book_title}"]`).remove();
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

let searcher = $('[name = "search"]');
let filter = $('[name = "filter"]');

let add_btn = $('.admin-search .add-new');

add_btn.on('click', () => {
    location.href = '/details';
})

searcher.on('keyup', book_search);
filter.on('change', book_search);

function book_search() {

    deactivate_itm('.loading-box', 'errorr');
    activate_itm('.loading-box');
    activate_itm('.loading');

    select('.row-items').innerHTML = '';

    search(searcher.val(), filter.val(), '/admin_book_search', (data)=> {

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