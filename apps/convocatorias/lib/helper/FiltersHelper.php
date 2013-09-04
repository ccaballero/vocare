<?php

function filters($type, $name, $convocatoria) {
    $return = '';

    switch ($type) {
        case 'items':
            $requerimientos = $convocatoria->getConvocatoriaRequerimientos();
            foreach ($requerimientos as $requerimiento) {
                $return .= '<tr><td width="10px">'
                         . '<input type="checkbox" name="' . $name
                         . '" value="'
                         . $requerimiento->getRequerimiento()->getId()
                         . '"></td><td>'
                         . $requerimiento->getRequerimiento()->getNombre()
                         . '</td></tr>';
            }
            $return = '<table>' . $return . '</table>';
            break;
        case 'status':
            $available_status = Doctrine::getTable('Postulante')->listStatus();
            foreach ($available_status as $key => $status) {
                $return .= '<tr><td width="10px">'
                         . '<input type="checkbox" name="' . $name
                         . '" value="' . $key . '"></td><td>'
                         . $status
                         . '</td></tr>';
            }
            $return = '<table>' . $return . '</table>';
            break;
    }

    return $return;
}
