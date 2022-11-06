<?php

require_once 'components/helper_functions.php';

function horizontal_list($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'text'  => '<span>Exciting stories</span> and the best books <span>from all genre</span>',
        'function'  => '',
        'icon'  => 'bi bi-person',
        'list'  => '',
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'horizontal_list p-rel ". $passed_properties['class'] ."' onclick = '\"". $passed_properties['function'] ."\";'>
            
            <div class = 'list_case'>
                <div class = 'list_items flex-row'>
                    ".$passed_properties['list']."
                </div>
            </div>

            <div class = 'list_control left p-abs' onclick = 'scroll_hrizontal(\".list_case\");'>
                <div class = 'round flex-center'>
                    <i class = 'bi bi-chevron-left'></i>
                </div>
            </div>

            <div class = 'list_control right p-abs' onclick = 'scroll_hrizontal(\".list_case\", false);'>
                <div class = 'round flex-center'>
                    <i class = 'bi bi-chevron-right'></i>
                </div>
            </div>
            
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/horizontal_list/horizontal_list.css'>";

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
