<?php

require_once 'components/helper_functions.php';

get_components([
    'abstract_bg',
    'navigation',
    'logo',
    'fancy_text',
    'button'
]);

function home_header($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    
    global $head;
    global $body;

    $default_properties = [
        'heading' => '<span>Exciting stories</span> and the best books <span>from all genre</span>',
        'text'    => "
            bringing you the best books and stories from all genre, 
            each paragraph offer's maximum satisfaction
        ",
        'image' => 'images/header_image2.png',
    ];

    compare_properties($default_properties, $passed_properties);

    //sub_components
    $abstract_bg =  
        abstract_bg([
            'image' => 'images/book_grid.jpg',
            'blur_intensity' => '20px',
            'class' => 'p-abs top-left z-1',
        ]);
    
    $navigation = 
        navigation([
            'class' => 'p-abs top-left full-vw z-5',
            
        ]);
    
    $fancy_text = fancy_text([
        'text' => $passed_properties['heading'],
    ]);

    $button = button([
        'name' => 'Start Reading'
    ]);

    //html for the component
    $component =  
    "
        <header class = 'full-vw p-rel content-padding'>

            $abstract_bg
            $navigation
        
        <div class = 'content p-rel full-hw z-2 flex-row'>
            <div class = 'left full-h flex-col-center half-w p-rel'>
                $fancy_text
                <div class = 'cta_vibes p-rel'>
                    <p>
                        ". $passed_properties['text'] ."
                    </p>
                </div>
                <div class = 'cta_btn'>
                    $button
                </div>
            </div>
            <div class = 'right full-h flex-col-center half-w p-rel'>
                <div class = 'image full-w'>
                    <img src = '". $passed_properties['image'] ."' class = 'obj-fit'>
                </div>
            </div>
        </div>
        </header>
    ";

    //style for the component
    $component_links = "<link rel = 'stylesheet' href = 'components/home_header/home_header.css'>";

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
