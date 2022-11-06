<?php

require_once 'components/helper_functions.php';

get_components([
    'fancy_text',
    'abstract_bg',
    'button',
]);

function footer($passed_properties = [], $main_component = true) {
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
    $year = date('Y');
    $component =  
    "
        <footer class = 'text-center p-2'>
            <span>© Copyright Maxnovels $year</span>
        </footer>
    ";

    //style for the abstract component
    $component_links = "<link rel = 'stylesheet' href = 'components/footer/footer.css'>";

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
