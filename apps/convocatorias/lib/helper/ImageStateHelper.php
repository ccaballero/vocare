<?php

function image_state($array_result = array()) {
    $flags = array('red', 'yellow', 'green');

    if (!empty($array_result)
        && isset($array_result['result'])) {
            $result = $array_result['result'];
            $message = isset($array_result['message']) ? $array_result['message'] : '';

            $flag = $flags[$result];

            return "<img src=\"/img/bullet_$flag.png\" alt=\"$message\" title=\"$message\" />";
    }

    return '';
}
