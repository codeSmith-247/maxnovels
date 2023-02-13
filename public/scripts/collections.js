
let search_ = $('input[name = "search"]');

search_.on('keyup', search);
$('.search-box button').on('click', search);


let searched_value = '';

function search() {

    $('.large-grid-box').html('');

    activate_itm('.loading-box');
    activate_itm('.loading');

    searched_value = search_.val();

    $.ajax({
        method: 'GET',
        url: '/home_search_collection',
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

            $('.large-grid-box').html(data);
        }
    })

}