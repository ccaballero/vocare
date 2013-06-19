<?php

function renderFormTypes($stdClass, $url) {
    return '<form method="post" action="' . $url . '">'
         . stdClassPrint($stdClass)
         . '<br /><p><input type="submit" value="Modificar Tipos" /></p>'
         . '</form>';
}

function stdClassPrint($stdClass, $attribute = '') {
    if (is_object($stdClass)) {
        $return = '';

        foreach ($stdClass as $attribute => $value) {
            $_value = !is_object($value) ? $value : '';

            $return .= '<li>'
                    . render_combo_types($attribute, $_value)
                    . $attribute
                    . stdClassPrint($value, $attribute)
                    . '</li>';
        }

        return '<ul>' . $return . '</ul>';
    }
}

function render_combo_types($name, $default = '') {
    $selected = ' selected="selected"';
    return '<select name="' . $name . '">'
         . '<option name="string"'
         . (($default == 'string') ? $selected : '')
         . '>cadena</option>'
         . '<option name="money"'
         . (($default == 'money') ? $selected : '')
         . '>moneda</option>'
         . '<option name="integer"'
         . (($default == 'integer') ? $selected : '')
         . '>entero</option>'
         . '<option name="date"'
         . (($default == 'date') ? $selected : '')
         . '>fecha</option>'
         . '<option name="time"'
         . (($default == 'time') ? $selected : '')
         . '>hora</option>'
         . '</select>';
}
