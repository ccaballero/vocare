<?php

function user_selector($users, $select_user = null, $name = '') {
    $result = '';

    foreach ($users as $user) {
        $selected = '';
        if (!empty($select_user) && $select_user->getId() == $user->getId()) {
            $selected = ' selected="selected"';
        }

        $value = ' value="' . $user->getId() . '"';
        $result .= '<option ' . $value . $selected . '>'
                . $user->getFullname() . '</option>';
    }

    $name = ' name="' . $name . '"';

    return '<select' . $name . '>' . $result . '</select>'
        . '<a onclick="return remove_li(this);">Remover</a>';
}
