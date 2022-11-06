
window.addEventListener('load', () => {
    activate_itm(".loader");
});

function loader_message(title, message){
    deactivate_itm(".loader");
    activate_itm(".loader", 'transparent');
    setTimeout( () => {
        Swal.fire({
            icon: "success",
            title: title,
            text: message
        });
        activate_itm(".loader");
    }, 5000);
};

function loader_msg(title, message, link){
    deactivate_itm(".loader");
    activate_itm(".loader", 'transparent');
    setTimeout( () => {
        Swal.fire({
            icon: "success",
            title: title,
            text: message
        }).then( () => {
            location.href = link;
        });
        activate_itm(".loader");
        
    }, 5000).then;
};