<?php

require_once 'components/helper_functions.php';

get_components([
    'fancy_text',
    'abstract_bg',
    'button',
]);

function four_box_section($passed_properties = [], $main_component = true) {
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
        'text' => '<span>All</span> You Can Have <span>In One Place</span>',
        'fancy_border' => false,
    ]);

    $heading_two = fancy_text([
        'text' => '<span>Never Miss</span> Any Of Your <span>Pages</span>',
        'fancy_border' => false,
    ]);

    $heading_three = fancy_text([
        'text' => '<span>Share </span> Inspirations With <span>Friends</span>',
        'fancy_border' => false,
    ]);

    $heading_four = fancy_text([
        'text' => '<span>Explore Our</span> Library Of <span>Books</span>',
        'fancy_border' => false,
    ]);


    $button = button([
        'name' => 'Start Reading'
    ]);



    //html for the abstract component
    $component =  
    "
        <section class = 'four_box_section full-vw p-rel'>

            <div class = 'box_case full-hw z-2 p-rel'>

                <div>
                    <div class = 'image ov-hidden'>
                        <img src = 'images/girl_holding_book_maxnovel.jpg' class = 'obj-fit'>
                    </div>
                    <div class = 'content flex-col-center'>
                        $heading_one
                        <p>
                            Maxnovels provides you with exciting books from all generes,
                            there are a lot of books to choose from, this is the best place
                            to start reading.
                        </p>
                        $button
                    </div>
                </div>

                <div>
                    <div class = 'image ov-hidden'>
                        <img src = 'images/guy_remembering.webp' class = 'obj-fit'>
                    </div>
                    <div class = 'content flex-col-center'>
                        $heading_two
                        <p>
                            Never miss a page with maxnovels, you can bookmark the paragraph where you
                            left off in a book and start from there on your next return.
                        </p>
                        $button
                    </div>
                </div>

                <div>
                    <div class = 'content flex-col-center'>
                        $heading_three
                        <p>
                            Did you find that paragraph that resonates with you? 
                            you can always share your inspiration on social media with maxnovels.
                        </p>
                        $button
                    </div>

                    <div class = 'image ov-hidden'>
                        <img src = 'images/share_on_social_media_maxnovels.png' class = 'obj-fit'>
                    </div>
                </div>

                <div>
                    <div class = 'content flex-col-center'>
                        $heading_four
                        <p>
                            Do not miss out on all the fun maxnovels has to provide, explore our library of books,
                            get inspired, inspire a generation.
                        </p>
                        $button
                    </div>

                    <div class = 'image ov-hidden'>
                        <img src = 'images/explore.png' class = 'obj-fit'>
                    </div>
                </div>

                
            </div>
        </section>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/four_box_section/four_box_section.css'>";

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
