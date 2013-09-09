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

function task_selector($tasks, $select_task = null, $name = '') {
    $result = '';

    preg_match('/\[(?P<time>.*)\](?P<task>.*)/', $select_task, $matches);
    $time = '900';
    if (isset($matches['time'])) {
        $time = $matches['time'];
    }

    foreach ($tasks as $key => $_task) {
        $selected = '';
        if (!empty($matches['task']) && $matches['task'] == $key) {
            $selected = ' selected="selected"';
        }

        $value = ' value="' . $key . '"';
        $result .= '<option ' . $value . $selected . '>'
                . $_task . '</option>';
    }

    $name = ' name="' . $name . '[]';

    return '<input style="width:45px;padding:1px;" class="text-right" '
        . 'type="text"' . $name . '[time]" value="' . $time . '" />&nbsp;'
        . '<select' . $name . '[task]" >' . $result . '</select>'
        . '<a onclick="return remove_li(this);">Remover</a>';
}
