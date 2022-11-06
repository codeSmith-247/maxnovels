<?php

require_once 'components/helper_functions.php';

get_components([
    'fancy_text',
    'horizontal_list',
    'book'
]);

function sign_up_modal($passed_properties = [], $main_component = true) {
    //retrieve the head and body store
    global $head;
    global $body;
    

    $default_properties = [];

    compare_properties($default_properties, $passed_properties);

    //sub components

    //html for the abstract component
    $component =  
    "
        <div class = 'signup modal_box full-vhw ov-hidden p-fix top-left flex-center'>

            <div class = 'p-rel'>
                <div class = 'modal-close-btn p-abs z-2'>
                    <div class = 'flex-center round'>
                        <i class = 'bi bi-x-lg'></i>
                    </div>
                </div>
        
                <div class = 'sign_up_modal p-rel z-1'>
        
                    <div class = 'modal-top p-rel'>
                        <span>
                            Sign Up
                        </span>
            
                        <p>
                            Join the best community, enjoy our collection of books, get inspired, inspire a generation
                        </p>
                    </div>
            
                    <div class = 'input-area'>
            
                        <div class = 'input'>
                            <label>Full Name</label>
                            <div class = 'input_box'>
                                <input type = 'text' name = 'fullname' placeholder = 'e.g Jhon Desmond'>
                            </div>
                        </div>
            
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
            
                        <div class = 'input'>
                            <label>Repeat Password</label>
                            <div class = 'input_box'>
                                <input type = 'password' name = 'repeat-password' placeholder = 'e.g myp@55w0rd$2323'>
                            </div>
                        </div>
            
                        <div class = 'input'>
                            <label>Gender</label>
                            <div class = 'input_box'>
                                <select name = 'gender'>
                                    <option value = 'male'>Male</option>
                                    <option value = 'female'>Female</option>
                                </select>
                            </div>
                        </div>
            
                        <div class = 'input dob'>
                            <label>Date Of Birth</label>
                            <div class = 'input_box flex-row'>
            
                                <div class = 'year'>
                                </div>
            
                                <div class = 'month'>
        
                                    <select id='month name='month'>
                                        <option>Month</option>
                                        <option value='01'>January</option>
                                        <option value='02'>February</option>
                                        <option value='03'>March</option>
                                        <option value='04'>April</option>
                                        <option value='05'>May</option>
                                        <option value='06'>June</option>
                                        <option value='07'>July</option>
                                        <option value='08'>August</option>
                                        <option value='09'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select>
        
                                </div>
            
                                <div class = 'day'>
                                </div>
            
                            </div>
                        </div>
        
                        <div class = 'button p-rel ov-hidden flex-row flex-center' onclick = ''>
                            <span class = 'p-rel z-2'> Sign Up </span>
                            <div class = 'button_cover p-abs p-center full-h z-1'>
                            </div>
                        </div>
        
                        <div class = 'bottom_link text-center p-1'>
                            <span>
                                Already have an account? 
                                <a href = '#'>Log In</a>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>

    ";

    //style for the abstract component
    $component_links = "
        <link rel = 'stylesheet' href = 'components/sign_up_modal/sign_up_modal.css'>
        <script src = 'components/sign_up_modal/sign_up_modal.js' defer></script>
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
