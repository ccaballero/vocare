<?php

function std_render($tpl, $vars) {
    return '<table class="stretch">'
           . implode('', std_render_tr($tpl, $vars))
           . '</table>';
}

function std_render_tr($tpl, $vars, $preffix = '') {
    $array = (array)$tpl;
    $form = array();

    foreach ($array as $key => $value) {
        if (is_string($value)) {
            $val = isset($vars->$key) ? $vars->$key : '';
            $form[] =<<<EOL
<tr><th>$preffix$key:</th><td><input type="text" value="$val" /></td></tr>
EOL;
        } else {
            $val = isset($vars->$key) ? $vars->$key : new StdClass();
                        
            $subs = std_render_tr($tpl->$key, $val, $key . '_');
            foreach ($subs as $sub) {
                $form[] = $sub;
            }
        }
    }

    return $form;
}
