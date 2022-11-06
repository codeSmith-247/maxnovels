<?php

require_once 'components/helper_functions.php';

function search_box($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'name'  => 'home',
        'function'  => '',
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'search_box flex-row ov-hidden'>
            <div class = 'input full-h'>
                <input class = 'full-hw' type = 'text' name = 'search' placeholder = 'Type your search here...'>
            </div>
            <div class = 'button full-h flex-center'>
                <i class = 'bi bi-search'></i>
            </div>
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/search_box/search_box.css'>";

    //and component and it's style to the body and head store respectively
        if(!str_contains($head, $component_links)) {
        $head .= $component_links;
    }

    if($main_component) {
        $body .= $component;
    }
    else {
        return $component;
    }
}
