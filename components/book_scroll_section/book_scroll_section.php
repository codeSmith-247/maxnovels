<?php

require_once 'components/helper_functions.php';

get_components([
    'fancy_text',
    'horizontal_list',
    'book'
]);

function book_scroll_section($passed_properties = [], $main_component = true) {
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
    $fancy_text = fancy_text([
        'text' => '<span>Our</span> Collection',
        'fancy_border' => false,
    ]);

    $book_list = '';

    $list = [
        [
            'image' => 'images/book_cover_1.jpeg',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],

        [
            'image' => 'images/book_cover_2.jpg',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],

        [
            'image' => 'images/book_cover_3.jpg',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],

        [
            'image' => 'images/book_cover_4.webp',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],

        [
            'image' => 'images/book_cover_5.jpeg',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],

        [
            'image' => 'images/book_cover_6.jpg',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],

        [
            'image' => 'images/book_cover_7.avif',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],

        [
            'image' => 'images/book_cover_8.jpg',
            'title' => 'This is the book title',
            'author' => 'This is the book author',
        ],
    ];

    foreach($list as $book) {
        
        $book_list .= book([
            'image'  => $book['image'],
            'title'  => $book['title'],
            'author' => $book['author'],
        ]);
    }

    $list = horizontal_list([
        'list' => $book_list,
    ]);

    //html for the abstract component
    $component =  
    "
        <section class = 'book_scroll_section p-rel flex-col-center ". $passed_properties['class'] ."' onclick = '\"". $passed_properties['function'] ."\";'>
            
            <div class = 'heading content-padding'>
                $fancy_text
            </div>

            <div class = 'scroll content-padding'>
                $list
            </div>
            
        </section>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/book_scroll_section/book_scroll_section.css'>";

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
