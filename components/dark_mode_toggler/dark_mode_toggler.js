
select('.dark_mode_toggler').addEventListener('click', () => {
    toggle_itm('body', 'darkmode');
    toggle_itm('.dark_mode_toggler .toggle_button');
})