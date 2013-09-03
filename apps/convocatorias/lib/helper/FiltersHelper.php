<?php

function filters($type, $convocatoria) {
    $return = '';

    switch ($type) {
        case 'items':
            $requerimientos = $convocatoria->getConvocatoriaRequerimientos();
            foreach ($requerimientos as $requerimiento) {
                $return .= '<tr><td width="10px"><input type="checkbox"></td><td>' . $requerimiento->getRequerimiento()->getNombre() . '</td></tr>';
            }
            $return = '<table>' . $return . '</table>';
            break;
        case 'status':
            $status = array();
    }

    return $return;
}
