<?php

function pretty_date($string_date) {
    if (!empty($string_date)) {
        $date = DateTime::createFromFormat('Y-m-d', $string_date);

        $months_es = array(
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        );
        $months_en = array(
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        );

        return $date->format('j \d\e ') .
            $months_es[intval($date->format('n')) - 1] .
            $date->format(' \d\e Y');
    }

    return '';
}
