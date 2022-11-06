<?php

require_once 'components/helper_functions.php';

function abstract_bg($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;


    $default_properties = [
        'image'          => 'images/abstract_image.webp', 
        'cover_color'    => '#f2f2f2',
        'cover_opacity'  => '0.8',
        'blur_intensity' => '5px',
        'height'         => '100%',
        'width'          => '100%',
        'class'          => 'p-rel',
    ];

    compare_properties($default_properties, $passed_properties);

    //html for the abstract component
    $component =  
    "
        <div class = 'abstract-bg ov-hidden ". $passed_properties['class'] ."' style = 'height: ". $passed_properties['height'] ."; width: ". $passed_properties['width'] .";'>
            <div class = 'image p-abs top-left full-hw z-1'>
                <img src = '". $passed_properties['image'] ."' class = 'obj-fit'>
            </div>
            <div class = 'cover-color p-abs top-left full-hw z-2' style = '--cover_color: ". $passed_properties['cover_color'] ."; --cover_opacity: ". $passed_properties['cover_opacity'] .";'></div>
            <div class = 'blur-cover p-abs top-left full-hw z-3' style = '--blur_intensity: ". $passed_properties['blur_intensity'] .";'></div>
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/abstract_bg/abstract_bg.css'>";

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
