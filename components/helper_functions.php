<?php

/**
 * function ensures that a given list of properties
 * has the same number of properties as the default
 * list of properties
 * 
 * @return array()
 */
function compare_properties($default_properties, &$passed_properties) {
    $default_keys = array_keys($default_properties); // retrives keys

    //compare and correct
    foreach($default_keys as $key) {

        if(!isset($passed_properties[$key])) {
            $passed_properties[$key] = $default_properties[$key];
        }
    }
}


function get_components($component_array) {

    foreach($component_array as $component) {
        require_once "components/$component/$component.php";
    }
}