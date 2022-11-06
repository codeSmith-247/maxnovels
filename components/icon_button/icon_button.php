<?php

require_once 'components/helper_functions.php';

function icon_button($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'icon'  => 'bi bi-facebook',
        'name'  => 'home',
        'color' => '#4267B2'
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <button class = 'icon_button flex-row flex-center p-1 ". $passed_properties['class'] ."' style = 'background: ". $passed_properties['color'] .";'>
            <div class = 'icon'>
                <i class = '". $passed_properties['icon'] ."'></i>
            </div>
            <span>". $passed_properties['name'] ."</span>
        </button>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/icon_button/icon_button.css'>";

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
