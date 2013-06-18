<?php

function stdClassPrint($stdClass, $attribute = '') {
    if (is_object($stdClass)) {
        $return = '';

        foreach ($stdClass as $attribute => $value) {
            $return .= '<li>'
                    . $attribute
                    . stdClassPrint($value, $attribute)
                    . '</li>';
        }

        return '<ul>' . $return . '</ul>';
    }
}
