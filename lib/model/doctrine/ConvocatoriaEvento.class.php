<?php

class ConvocatoriaEvento extends BaseConvocatoriaEvento
{
    public function getPrettyFecha() {
        include_once realpath(dirname(__FILE__)
            . '/../../../apps/convocatorias/lib/helper/PrettyDateHelper.php');
        return pretty_date($this->_get('fecha'));
    }
}
