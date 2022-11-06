<?php

require_once 'components/helper_functions.php';

get_components([
    'abstract_bg',
    'navigation',
    'fancy_text'
]);

function short_header($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'name'  => 'home',
        'function'  => '',
    ];

    compare_properties($default_properties, $passed_properties);

    //sub components
    $background = abstract_bg([
        'class' => 'p-abs top-left full-hw z-1',
        'cover_color' => '#222',
        'cover_opacity' => '0.8',
        'blur_intensity' => '0',
        'image' => 'images/collections_bg_maxnovels.png',
    ]);

    $fancy_text = fancy_text([
        'text' => 'Our <span>Collection</span>',
    ]);

    $navigation = 
        navigation([
            'class' => 'p-abs top-left full-vw z-5',
            
        ]);

    //html for the abstract component
    $component =  
    "
        <header class = 'short_header p-rel'>
            $background
            $navigation
            <div class = 'p-rel full-hw flex-center text-center'>
                $fancy_text
            </div>
        </header>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/short_header/short_header.css'>";

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
