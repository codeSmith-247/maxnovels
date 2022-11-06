<?php

require_once 'components/helper_functions.php';

get_components([
    'fancy_text',
    'abstract_bg',
    'button',
]);

function double_box_section($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'text'  => '<span>Exciting stories</span> and the best books <span>from all genre</span>',
        'function'  => '',
        'icon'  => 'bi bi-person'
    ];

    compare_properties($default_properties, $passed_properties);

    //sub components
    // $abstract_bg = abstract_bg([
    //     'image' => 'images/section_bg.jpg',
    //     'blur_intensity' => '30px',
    //      'cover_color' => '#333',
    // ]);

    $heading_one = fancy_text([
        'text' => '<span>Are </span> You A <span>Content Creator</span>',
        'fancy_border' => false,
    ]);

    $button = button([
        'name' => 'Join Maxnovels'
    ]);



    //html for the abstract component
    $component =  
    "
        <section class = 'double_box_section full-vw p-rel'>

            <div class = 'box_case full-hw z-2 p-rel flex-col flex-center text-center'>

                <div>
                    <div class = 'image ov-hidden'>
                        <img src = 'images/content_writer_maxnovel.png' class = 'obj-fit'>
                    </div>
                </div>

                <div class = 'flex-col flex-center text-center'>
                    
                    $heading_one
                    <p>
                        Join Our community of writers, write some books, get connected with other writers,
                        get recognised by the community, have fun!
                    </p>
                    $button
                    
                </div>

            </div>
        </section>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/double_box_section/double_box_section.css'>";

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
