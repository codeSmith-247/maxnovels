<?php

require_once 'components/helper_functions.php';

get_components([
    'icon_button',
]);

function log_in_modal($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [];

    compare_properties($default_properties, $passed_properties);

    //sub components
    $facebook_button = icon_button([
        'class' => 'full-w',
        'name'  => 'Log in with Facebook'
    ]);

    $google_button = icon_button([
        'class' => 'full-w',
        'name'  => 'Log in with Google',
        'color' => '#db3236',
        'icon'  => 'bi bi-google'
    ]);

    //html for the abstract component
    $component =  
    "
        <div class = 'login modal_box full-vhw ov-hidden p-fix top-left flex-center'>

            <div class = 'p-rel'>
                <div class = 'modal-close-btn p-abs z-2'>
                    <div class = 'flex-center round'>
                        <i class = 'bi bi-x-lg'></i>
                    </div>
                </div>
        
                <div class = 'sign_up_modal p-rel z-1'>
        
                    <div class = 'modal-top p-rel'>
                        <span>
                            Log In
                        </span>
            
                        <p>
                            Welcome back
                        </p>
                    </div>
            
                    <div class = 'input-area'>
            
                        <div class = 'input'>
                            <label>Email Address</label>
                            <div class = 'input_box'>
                                <input type = 'email' name = 'email' placeholder = 'e.g myemail@gmail.com'>
                            </div>
                        </div>
            
                        <div class = 'input'>
                            <label>Password</label>
                            <div class = 'input_box'>
                                <input type = 'password' name = 'password' placeholder = 'e.g myp@55w0rd$2323'>
                            </div>
                        </div>
        
                        <div class = 'button p-rel ov-hidden flex-row flex-center' onclick = ''>
                            <span class = 'p-rel z-2'> Log In </span>
                            <div class = 'button_cover p-abs p-center full-h z-1'>
                            </div>
                        </div>
        
                        <div class = 'bottom_link text-center p-1'>
                            <span>
                                Do not have an account? 
                                <a href = '#'>Sign Up</a>
                            </span>
                        </div>

                        <div class = 'login_with'>
                            $facebook_button
                        </div>

                        <div class = 'login_with'>
                            $google_button
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>

    ";

    //style for the abstract component
    $component_links = "
        <link rel = 'stylesheet' href = 'components/sign_up_modal/sign_up_modal.css'>
        <script src = 'components/log_in_modal/log_in_modal.js' defer></script>
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
