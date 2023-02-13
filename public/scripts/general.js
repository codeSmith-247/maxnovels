function select(target) {
    return document.querySelector(target);
}

function selectAll(target) {
    return document.querySelectorAll(target);
}

function remove_itm(target, victim) {
    if(typeof(target) == 'string')
    if(select(target) != null)    
    select(target).querySelectorAll(victim).forEach( victim => {
            victim.remove();
        })
        
    else target.querySelectorAll(victim).forEach( victim => {
        victim.remove();
    });
}

function activate_itm(target, class_name = 'active') {
    if(select(target) != null)
    select(target).classList.add(class_name);
}

function deactivate_itm(target, class_name = 'active') {
    if(select(target) != null)
    select(target).classList.remove(class_name);
}

function activateAll(target, class_name = 'active') {
    selectAll(target).forEach(victim => {
        victim.classList.add(class_name);
    });
}

function deactivateAll(target, class_name = 'active') {
    selectAll(target).forEach(victim => {
        victim.classList.remove(class_name);
    });
}

function toggle_itm(target, class_name = 'active') {
    if(select(target) != null)
    select(target).classList.toggle(class_name);
}

function year_generator(start_year, end_year) {

    let select = document.createElement('select');
    let option = document.createElement('option');

    select.setAttribute('name', 'year');


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

    select.setAttribute('name', 'day');

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

function scroll_horizontal(target, left = true) {

    target = select(target);

    if(left)
    target.scrollBy({left: -250, behavior: "smooth"});
    
    else 
    target.scrollBy({left: 250, behavior: "smooth"});
    
}

function search(search_value, search_filter, search_url, search_callback) {

    $.ajax({
        method: 'GET',
        url: search_url,
        data: {search: search_value, filter: search_filter},
        success: (data) => {
            search_callback(data);
        }
    })

}

if(sessionStorage.getItem('darkmode') == null) {
    sessionStorage.setItem('darkmode', 'true');
}

function darkmode_the_ui() {
    if(sessionStorage.getItem('darkmode') == 'true') {
        activate_itm('body', 'darkmode');
        activate_itm('.mode-toggler');
    } else {
        deactivate_itm('body', 'darkmode');
        deactivate_itm('.mode-toggler');
    }

}

function show_password(target, parent) {
    target = select(`[name = "${target}"]`);

    toggle_itm(parent);

    if(target.getAttribute('type') == 'password') {
        target.setAttribute('type', 'text');
    }
    else target.setAttribute('type', 'password');
}

darkmode_the_ui();

function mode() {

    let darkmode = sessionStorage.getItem('darkmode');
    darkmode = darkmode == 'true' ? 'false' : 'true';
    sessionStorage.setItem('darkmode', darkmode);
    darkmode_the_ui();

}

let wrapper = select('.wrapper');

function set_ajax() {
    $.ajaxSetup({
        'headers': {
            'X-CSRF-TOKEN' : $('meta[name = "CSRF_TOKEN"]').attr('content')
        }
    });
}

wrapper.addEventListener('scroll', () => {

    if(wrapper.scrollTop > 300) {
        activate_itm('nav');
    }
    else deactivate_itm('nav');
});


        // Initialize the agent at application startup.
const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
    .then(FingerprintJS => FingerprintJS.load())

// Get the visitor identifier when you need it.
fpPromise
    .then(fp => fp.get())
    .then(result => {
    // This is the visitor identifier:
    const visitorId = result.visitorId

    set_ajax();

    $.ajax({
        method: 'POST',
        url: '/fingerprint',
        data: {'fingerprint': visitorId, 'os': result.components.platform.value},
        success: (data) => {
            console.log(data);
            console.table('finger de printes');
        }
    })
})


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