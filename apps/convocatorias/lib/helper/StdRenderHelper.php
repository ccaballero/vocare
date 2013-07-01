<?php

function std_render($tpl) {
    $array = (array)$tpl;
    
    $form = array();
    
    foreach ($array as $key => $value) {
        $form[] = '<tr><th>' . $key .':</th><td><input type="text" /></td></tr>';
    }
    
    return '<table class="stretch">' . implode('', $form) . '</table>';
}
