
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
        url: '/books_search',
        data: {
            'filter' : $('select[name = "filter"]').val(),
            'search'  : searched_value,
            'category' : category,
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