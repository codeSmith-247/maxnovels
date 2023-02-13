

function bookmark() {

    set_ajax();

    let bookmark_state = true;

    if(select('.bookmark').classList.contains('active')) bookmark_state = false;

    alert({type: 'loading'});

    $.ajax({
        method: 'get',
        url: '/bookmark/' + $('meta[name = "book"]').attr('content') + '/' + $('meta[name = "chapter"]').attr('content'),
        data: {state: bookmark_state},
        success: (data) => {
            alert_reset();
            console.log(data);
            if(data.status == 'fail') {

                $('.alert-case button.first').click(() => {
                    location.href = '/login';
                });

                alert({type: "warning", message: "You need to be signed in to use the bookmark feature", first_btn: 'Sign In'});
            }
            else if(data.status == 'success' && bookmark_state) {
                activate_itm('.menu-btn.bookmark'); 

                select('.bookmark-menu').insertAdjacentHTML('afterbegin',
                    `
                    <div class = 'menu-item  flex-row active' onclick = 'location.href = "/read/${$('meta[name = "book_title"]').attr('content')}/${$('meta[name = "chapter_title"]').attr('content')}";'>
                        <i class = 'bi bi-bookmark'></i>
                        <span>${$('meta[name = "chapter_title"]').attr('content')}</span>
                    </div>
                    `
                );

                select('.bookmark-menu p.text-center').style.display = 'none';


            }
            else {
                deactivate_itm('.menu-btn.bookmark');

                select('.bookmark-menu .menu-item.active').remove();

                let bookmark_size = select('.bookmark-menu').innerText.length;

                console.log(bookmark_size);

                if(bookmark_size == 0) {
                    select('.bookmark-menu p.text-center').style.display = 'block';
                }
            }

        }
    });
}

var quill = new Quill('.reader-slate', {
    theme: 'bubble',
    readOnly: true
});

quill.setContents(JSON.parse($('meta[name = "content"]').attr('content')));


function see_bookmarks() {
    activate_itm('.tab_select .bookmarks');
    deactivate_itm('.tab_select .chapters');
    deactivateAll('.bookmark-menu', 'disabled');
    activateAll('.chapter-menu', 'disabled');
}

function see_chapters() {
    activate_itm('.tab_select .chapters');
    deactivate_itm('.tab_select .bookmarks');
    deactivateAll('.chapter-menu', 'disabled');-
    activateAll('.bookmark-menu', 'disabled');
}