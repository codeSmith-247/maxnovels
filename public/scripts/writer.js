var toolbarOptions = [

    [{ 'font': [] }],
    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'align': [] }],

    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['code-block'],
  
    // [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    // [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    // [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction
  
    // [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
  
    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    
    ['image', 'video'],
    // ['clean']     
]

var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    }
});

quill.setContents(JSON.parse($('meta[name = "draft"]').attr('content')));


function save(only_save = true) {

    let return_value = false;

    if(content_size() <= 0) {

        alert({
           type: 'error',
           message: 'No content to save, please fill in contents an try again.'
        });

        return return_value;
    }

    alert({
        type: 'darkmode',
        message: 'saving',
    });

    set_ajax();

    $.ajax({
        method : 'POST',
        url    : '/save_chapter',
        data   : {
            'title'      : $('input[name="title"]').val(),
            'content'    : getContents(),
            'chapter_id' : $('meta[name = "chapter"]').attr('content'),
            'book_id'    : $('meta[name = "book"]').attr('content'),
        },
        success: (data) => {
            console.log(data);
            if(data.status == 'success') {

                
                if(only_save) {

                    alert({
                        type: 'success',
                        message: 'Chapter Saved'
                    });

                    window.removeEventListener('beforeunload', prevent_reload);
                    location.href = `/writer/${data.book}/${data.chapter}`;
                }
                else {
                    publish();
                }

                return_value = true;

            }
            else {
                alert({
                    type: 'error',
                    message: 'A chapter with this title already exists.'
                });

                return_value = false;
            }
        }
    });

    return return_value;
}

function publish() {

    if(content_size() <= 59) {

        alert({
           type: 'error',
           message: 'The contents of this chapter is too small, please fill in more content and try again.'
        });

        return false;
    }

    $.ajax({
        method : 'POST',
        url    : '/publish_chapter',
        data   : {
            'book_id'    : $('meta[name = "book"]').attr('content'),
            'chapter_id' : $('meta[name = "chapter"]').attr('content'),
        },
        success: (data) => {
            if(data.status == 'success') {
                alert({
                    type: 'success',
                    message: 'Chapter Published'
                });
                window.removeEventListener('beforeunload', prevent_reload);
                location.href = `/writer/${data.book}/${data.chapter}`;
            }
            else {
                alert({
                    type: 'error',
                    message: 'Unable to publish chapter, please try again later.'
                });

                return_value = false;
            }
        }
    })

}

function delete_prompt() {

    set_ajax();
    
    alert({
        type: 'warning',
        message: 'You are about to delete this chapter, make sure you want to do this, once this chapter is delete it cannot be restored.',
        first_btn: 'Delete',
    });

    select('.alert-case.alert button.first').setAttribute('onclick', 'delete_();');
}

function delete_() {

    $.ajax({
        method : 'POST',
        url    : '/delete_chapter',
        data   : {
            'book_id'    : $('meta[name = "book"]').attr('content'),
            'chapter_id' : $('meta[name = "chapter"]').attr('content'),
        },
        success: (data) => {
            if(data.status = 'success') {
                alert({
                    type: 'success',
                    message: 'Chapter Deleted'
                });
                window.removeEventListener('beforeunload', prevent_reload);
                location.href = '/chapters/' + $('meta[name = "book_title"]').attr('content');
            }
        }
    })
}

function getContents() {
    return JSON.stringify(quill.getContents());
}

function content_size() {
    let total_length = 0;

    selectAll('#editor p').forEach( paragraph => {
        total_length += paragraph.innerHTML.length;
    })

    console.log('checked: ', total_length);

    return total_length;
}

function prevent_reload(e) {
    e.preventDefault();
    console.log();
    e.returnValue = '';
}


window.addEventListener('beforeunload', prevent_reload);