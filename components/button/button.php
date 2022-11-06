<?php

require_once 'components/helper_functions.php';

function button($passed_properties = [], $main_component = false) {
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
        <div class = 'button p-rel ov-hidden flex-row flex-center". $passed_properties['class'] ."' onclick = '". $passed_properties['function'] ."'>
            <span class = 'p-rel z-2'> ". $passed_properties['name'] ." </span>
            <div class = 'button_cover p-abs p-center full-h z-1'>
            </div>
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/button/button.css'>";

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
