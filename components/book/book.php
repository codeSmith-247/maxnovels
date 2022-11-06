<?php

require_once 'components/helper_functions.php';

get_components([
    'button',
]);

function book($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'title'  => 'The title of the book',
        'author'  => 'The author of the book',
        'image'  => 'images/book_cover_4.webp'
    ];

    compare_properties($default_properties, $passed_properties);

    //sub components

    $button = button([
        'name' => 'Read'
    ]);

    //html for the abstract component
    $component =  
    "
        <div class = 'book'>
            <div class = 'image ov-hidden'>
                <img src = '".$passed_properties['image']."' class = 'obj-fit'>
            </div>
            <div class = 'info'>
                <h5>".$passed_properties['title']."</h5>
                <div>
                    <span>By:</span>
                    <span>".$passed_properties['author']."</span>
                </div>

                <div class = 'book_button'>
                    $button
                </div>

            </div>
        </div>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/book/book.css'>";

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
