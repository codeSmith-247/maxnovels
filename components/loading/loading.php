<?php

require_once 'components/helper_functions.php';

function loading($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'loader p-fix top-left full-vhw z-10 flex-col flex-center'>
            <div class = 'ball-box flex-center flex-col'>
                <div class = 'ball p-rel z-2'></div>
                <div class = 'base-ball p-rel z-1'></div>
            </div>
            <div class = 'text-center' onclick = ''>Loading...</div>
        </div>
    ";

    //style for the abstract component
    $component_links = "
        <link rel = 'stylesheet' href = 'components/loading/loading.css'>
        <script src = 'components/loading/loading.js' defer></script>
    ";

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
