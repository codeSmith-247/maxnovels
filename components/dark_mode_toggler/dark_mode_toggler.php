<?php

require_once 'components/helper_functions.php';

get_components([
    'toggle_button',
]);

function dark_mode_toggler($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [];

    compare_properties($default_properties, $passed_properties);

    //sub components
    // $abstract_bg = abstract_bg([
    //     'image' => 'images/section_bg.jpg',
    //     'blur_intensity' => '30px',
    //      'cover_color' => '#333',
    // ]);



    //html for the abstract component
    $toggle_button = toggle_button([
        'first_icon'  => 'bi bi-moon-fill',
        'second_icon' => 'bi bi-sun-fill',
    ]);

    $component =  
    "
        <div class = 'dark_mode_toggler p-fix round flex-center'>
            $toggle_button
        </div>
    ";

    //style for the abstract component
    $component_links = "
        <link rel = 'stylesheet' href = 'components/dark_mode_toggler/dark_mode_toggler.css'>
        <script src = 'components/dark_mode_toggler/dark_mode_toggler.js' defer></script>
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
