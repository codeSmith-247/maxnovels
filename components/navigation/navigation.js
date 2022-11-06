
function open_menu() {
    toggle_itm('.navigation');
    toggle_itm('nav .toggle_button');
}

parent = select('.wrapper');

parent.onscroll = () => {
    if(parent.scrollTop > 150) {
        activate_itm('nav');
        return true;
    }

    deactivate_itm('nav');
    return false;
}