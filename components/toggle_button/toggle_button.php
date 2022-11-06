<?php

require_once 'components/helper_functions.php';

function toggle_button($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'first_icon'  => 'bi bi-list',
        'second_icon'  => 'bi bi-x-lg',
        'function'  => '',
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'toggle_button p-rel ov-hidden flex-center round ". $passed_properties['class'] ."' onclick = '". $passed_properties['function'] ."'>
            <i class = '".$passed_properties['first_icon']."'></i>
            <i class = '".$passed_properties['second_icon']."'></i>
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/toggle_button/toggle_button.css'>";

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
