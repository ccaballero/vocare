<?php

class Convocatoria extends BaseConvocatoria
{
    protected $_opciones = null;

    public function __toString() {
        return '[' . $this->getEstado() . '] ' . $this->getNombre();
    }

    public function getAcciones() {
        return array('promover', 'enmendar', 'finalizar', 'anular', 'eliminar');
    }

    public function getOpciones() {
        if ($this->_opciones == null) {
            switch ($this->getEstado()) {
                case 'borrador':
                    $this->_opciones = array('promover', 'eliminar');
                    break;
                case 'emitido':
                    $this->_opciones = array('promover', 'enmendar', 'anular');
                    break;
                case 'anulado':
                    $this->_opciones = array();
                    break;
                case 'vigente':
                    $this->_opciones = array('finalizar', 'anular');
                    break;
                case 'finalizado':
                    $this->_opciones = array();
                    break;
                case 'eliminado':
                    $this->_opciones = array();
                    break;
            }
        }

        return $this->_opciones;
    }
    
    public function tieneAccion($accion) {
        return in_array($accion, $this->getOpciones());
    }
}
