<?php

require_once 'components/helper_functions.php';

function fancy_text($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'text'  => '<span>Exciting stories</span> and the best books <span>from all genre</span>',
        'function'  => '',
        'size'  => '',
        'fancy_border' => true,
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'fancy_text p-rel ". $passed_properties['class'] ."' onclick = '\"". $passed_properties['function'] ."\";'>
            <div class = 'p-rel z-2'>
                <span> ". $passed_properties['text'] ." </span>
            </div>
    ";

    $component .= $passed_properties['fancy_border'] ?

        "<div class = 'fancy_border p-abs full-h z-1'></div>
        </div>" :

        "</div>";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/fancy_text/fancy_text.css'>";

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
