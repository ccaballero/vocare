<?php

class Convocatoria extends BaseConvocatoria
{
    public static $OPERACIONES_POSIBLES = 5;

    protected $_estados_posibles = array(
        'borrador',
        'emitido',
        'anulado',
        'vigente',
        'finalizado',
        'eliminado',
    );

    protected $_operaciones_posibles = array(
        'eliminar' => array(
            'eliminar',
            '¿Esta seguro que desea eliminar esta convocatoria?',
        ),
        'promover' => array(
            'promover',
            '¿Esta seguro que desea promover esta convocatoria? Esto convertirá a esta en una convocatoria emitida',
        ),
        'enmendar' => array(
            'enmendar',
            '¿Esta seguro que desea enmendar esta convocatoria?',
        ),
        'anular' => array(
            'anular',
            '¿Esta seguro que desea anular la convocatoria?',
        ),
        'finalizar' => array(
            'finalizar',
            '¿Esta seguro que desea finalizar esta convocatoria?',
        ),
    );

    protected $_operaciones_disponibles = array();

    public function __toString() {
        return '[' . $this->getEstado() . '] ' . $this->getNombre();
    }

    public function getOperacionesPosibles() {
        return $this->_operaciones_posibles;
    }

     public function getOperacionesDisponibles() {
        if ($this->_operaciones_disponibles == null) {
            switch ($this->getEstado()) {
                case 'borrador':
                    $this->_operaciones_disponibles = array('eliminar', 'promover');
                    break;
                case 'eliminado':
                    $this->_operaciones_disponibles = array();
                    break;
                case 'emitido':
                    $this->_operaciones_disponibles = array('promover', 'enmendar', 'anular');
                    break;
                case 'vigente':
                    $this->_operaciones_disponibles = array('anular', 'finalizar');
                    break;
                case 'anulado':
                    $this->_operaciones_disponibles = array();
                    break;
                case 'finalizado':
                    $this->_operaciones_disponibles = array();
                    break;
            }
        }

        return $this->_operaciones_disponibles;
    }

    public function hasOperacion($operacion) {
        return in_array($operacion, $this->getOperacionesDisponibles());
    }

    public function getTotalRequerimientos() {
        $q = Doctrine_Query::create()
            ->select('SUM(cr.cantidad_requerida)')
            ->from('Requerimiento r')
            ->leftJoin('r.ConvocatoriaRequerimiento cr')
            ->where('cr.convocatoria_id = ?', $this->getId());

        $array = $q->fetchArray();
        return $array[0]['SUM'];
    }
}
