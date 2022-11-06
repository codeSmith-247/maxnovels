<?php

require_once 'components/helper_functions.php';

get_components([
    'logo',
    'nav_button',
    'button',
    'toggle_button'
]);

function navigation($passed_properties = [], $main_component = false) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [
        'class' => '',
        'links' => [

                [
                    'name' => 'Our Collection',
                    'link' => '#',
                    'icon' => 'bi bi-collection'
                ],

                [
                    'name' => 'Community',
                    'link' => '#',
                    'icon' => 'bi bi-people'
                ],

                [
                    'name' => 'Browse',
                    'link' => '#',
                    'icon' => 'bi bi-file-richtext'
                ],

                [
                    'name' => 'Log In',
                    'link' => '#',
                    'icon' => 'bi bi-box-arrow-in-right',
                    'class' => 'login_link',
                ],

                [
                    'name'  => 'Sign up',
                    'class' => 'signup_link',
                    'link'  => '#',
                    'icon'  => 'bi bi-x-diamond'
                ],
            ],
    ];

    compare_properties($default_properties, $passed_properties);

    //sub components
    $logo = 
        logo();

    $nav_links = '';

    foreach($passed_properties['links'] as $value) {

        $nav_links .= nav_button($value);

    }

    $button = button([
        'name' => 'Sign Up',
        'function' => 'activate_sign_up();'
    ]);

    $toggle_button = toggle_button([
        'function' => 'open_menu();',
    ]);

    //html for the abstract component
    $component =  
    "
        <nav class = 'flex-row flex-between content-padding ". $passed_properties['class'] ."'>

            $logo

            <div class = 'navigation flex-row z-1'>
                $nav_links
                $button
            </div>

            <div class = 'toggle_button_case p-rel z-2'>
                $toggle_button
            </div>
        </nav>
    ";

    //style for the abstract component
    $component_links = "
        <link rel = 'stylesheet' href = 'components/navigation/navigation.css'>
        <script src = 'components/navigation/navigation.js' defer></script>
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
