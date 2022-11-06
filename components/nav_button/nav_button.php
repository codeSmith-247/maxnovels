<?php

require_once 'components/helper_functions.php';

function nav_button($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'name'  => 'home',
        'link'  => '/',
        'icon'  => 'bi bi-person',
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'nav_button p-rel ". $passed_properties['class'] ."' onclick = 'location.href = \"". $passed_properties['link'] ."\";'>
            <div class = 'flex-row'>
                <div class = 'icon flex-center'>
                    <i class = '". $passed_properties['icon'] ."'></i>
                </div>
                <span> ". $passed_properties['name'] ." </span>
            </div>
            <div class = 'bottom_stick full-w flex-center p-abs '>
                <div class = 'stick'></div>
            </div>
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/nav_button/nav_button.css'>";

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
