<?php

require_once 'components/helper_functions.php';

function large_card($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'name'  => 'Romance',
        'number' => '2053',
        'image' => 'images/romance_genre_maxnovels.webp',
        'function'  => '',
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'large_card p-rel ov-hidden ". $passed_properties['class'] ."' onclick = '". $passed_properties['function'] ."'>
            <div class = 'card_box full-hw'>
                <div class = 'image p-rel'>
                    <img src = '". $passed_properties['image'] ."' class = 'obj-fit p-rel z-1'>
                    <div class = 'hover p-abs top-left full-hw flex-center z-2'>
                        <div class = 'hover-button '>Explore</div>
                    </div>
                </div>

                <div class = 'content full-w p-1'>
                    <div class = 'bold-text'>
                        <span>". $passed_properties['name'] ."</span>
                    </div>

                    <div class = 'details flex-row'>
                        <div class = 'detail'>
                            <i class = 'bi bi-book'></i>
                            <span>Books</span>
                            <span>". $passed_properties['number'] ."</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/large_card/large_card.css'>";

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
