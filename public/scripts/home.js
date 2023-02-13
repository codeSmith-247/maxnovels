
$(document).click(function() {
    deactivate_itm('.result');
});

$(".result").click(function(event) {
    // alert('clicked inside');
    event.stopPropagation();
});

$(".search button").click(function(event) {
    // alert('clicked inside');
    event.stopPropagation();
});


// $('select[name = "filter"]').on('change', search);
$('input[name = "search"]').on('keyup', search);
$('.search button').on('click', search);

function search() {

    let search_value = $('input[name = "search"]').val()

    if(search_value.replaceAll(' ', '') == '') {
        deactivate_itm('.result');
        return false;
    }

    set_ajax();

    activate_itm('.loading');
    deactivate_itm('.loading', 'errorr');
    activate_itm('.result');



    $.ajax({
        method: 'GET',
        url: '/home_search',
        data: {
            filter: '',
            search: search_value,
        },

        success: (data) => {

            deactivate_itm('.loading');

            $('.result .results').html(data);

            if(data.length <= 0) {
                activate_itm('.loading', 'errorr');
            }
        

        }
        
    })
}

