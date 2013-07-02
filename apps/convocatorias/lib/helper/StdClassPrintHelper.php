<?php

function stdClassPrint($stdClass, $attributes = array()) {
    if (is_object($stdClass)) {
        $return = '';

        foreach ($stdClass as $attribute => $value) {
            $_attributes = array_merge($attributes, array($attribute));
            $return .= '<li>'
                    . $attribute
                    . stdClassPrint($value, $_attributes)
                    . '</li>';
        }

        return '<ul>' . $return . '</ul>';
    }
}
