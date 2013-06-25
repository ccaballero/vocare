<?php

function renderFormTypes($stdClass, $url) {
    return '<form method="post" action="' . $url . '">'
         . stdClassPrint($stdClass)
         . '<br /><p><input type="submit" value="Modificar Tipos" /></p>'
         . '</form>';
}

function stdClassPrint($stdClass, $attributes = array()) {
    if (is_object($stdClass)) {
        $return = '';

        foreach ($stdClass as $attribute => $value) {
            $_attributes = array_merge($attributes, array($attribute));
            
            $_value = !is_object($value) ? $value : '';
            $_combo = !is_object($value) ? render_combo_types(
                'types[' . implode('][',
                $_attributes) . ']', $_value) : '';

            $return .= '<li>'
                    . $_combo
                    . $attribute
                    . stdClassPrint($value, $_attributes)
                    . '</li>';
        }

        return '<ul>' . $return . '</ul>';
    }
}

function render_combo_types($name, $default = '') {
    $selected = ' selected="selected"';
    return '<select name="' . $name . '">'
         . '<option value="string"'
         . (($default == 'string') ? $selected : '')
         . '>cadena</option>'
         . '<option value="money"'
         . (($default == 'money') ? $selected : '')
         . '>moneda</option>'
         . '<option value="integer"'
         . (($default == 'integer') ? $selected : '')
         . '>entero</option>'
         . '<option value="date"'
         . (($default == 'date') ? $selected : '')
         . '>fecha</option>'
         . '<option value="time"'
         . (($default == 'time') ? $selected : '')
         . '>hora</option>'
         . '</select>';
}
