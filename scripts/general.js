function select(target) {
    return document.querySelector(target);
}

function selectAll(target) {
    return document.querySelectorAll(target);
}

function remove_itm(target, victim) {
    if(typeof(target) == 'string')
        select(target).querySelectorAll(victim).forEach( victim => {
            victim.remove();
        })
        
    else target.querySelectorAll(victim).forEach( victim => {
        victim.remove();
    });
}

function activate_itm(target, class_name = 'active') {
    select(target).classList.add(class_name);
}

function deactivate_itm(target, class_name = 'active') {
    select(target).classList.remove(class_name);
}

function toggle_itm(target, class_name = 'active') {
    select(target).classList.toggle(class_name);
}

function year_generator(start_year, end_year) {

    let select = document.createElement('select');
    let option = document.createElement('option');

    option.value = 'Year';
    option.innerHTML = 'Year';

    select.appendChild(option);

    while(start_year <= end_year) {
        option = document.createElement('option');
        option.value = start_year;
        option.innerHTML = start_year;

        select.appendChild(option);

        start_year++;
    }

    return select;
}

function day_generator(start_day, end_day) {

    let select = document.createElement('select');
    let option = document.createElement('option');

    option.value = 'Day';
    option.innerHTML = 'Day';

    select.appendChild(option);

    while(start_day <= end_day) {
        option = document.createElement('option');
        option.value = start_day;
        option.innerHTML = start_day;

        select.appendChild(option);

        start_day++;
    }

    return select;
}

function scroll_hrizontal(target, left = true) {

    if(left)
    select(target).scrollBy({left: -250, behavior: "smooth"});
    
    else 
    select(target).scrollBy({left: 250, behavior: "smooth"});
    
}