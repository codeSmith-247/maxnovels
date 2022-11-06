<?php

require_once 'components/helper_functions.php';

get_components([
    'large_card',
    'button',
]);

function large_card_box($passed_properties = [], $main_component = true) {
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
    $large_card = large_card();
    $cards = '';

    $button = button([
        'name' => 'Show More',
    ]);

    $card_list = [
        [
            'name'  => 'Romance',
            'number' => '2053',
            'image' => 'images/romance_genre_maxnovels.webp',
        ],

        [
            'name'  => 'Suspense',
            'number' => '3402',
            'image' => 'images/suspense_genre_maxnovels.webp',
        ],

        [
            'name'  => 'Science Fiction',
            'number' => '3402',
            'image' => 'images/science_fiction_genre_maxnovels.jpg',
        ],

        [
            'name'  => 'Mystery',
            'number' => '2053',
            'image' => 'images/mystery_genre_maxnovels.jpeg',
        ],

        [
            'name'  => 'Business',
            'number' => '3402',
            'image' => 'images/business_genre_maxnovels.jpg',
        ],

        [
            'name'  => 'Contemporary',
            'number' => '3402',
            'image' => 'images/contemporary_genre_maxnovels.jpg',
        ]
    ];

    foreach($card_list as $card) {
        $cards .= large_card($card);
    }



    //html for the abstract component
    $component =  
    "
        <section class = 'large_card_box content-padding'>

            <div class = 'box-top'></div>

            <div class = 'card-container'>
                $cards
            </div>

            <div class = 'bottom flex-row flex-end'>
                $button
            </div>

        </section>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/large_card_box/large_card_box.css'>";

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
