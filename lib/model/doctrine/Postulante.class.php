<?php

class Postulante extends BasePostulante
{
    public function getFullName() {
        return implode(' ', array(
            $this->getApellidoPaterno(),
            $this->getApellidoMaterno(),
            $this->getNombres(),
        ));
    }
    
    public function displayNumeroHojas() {
        $numero_hojas = $this->getNumeroHojas();
        if ($numero_hojas == 0) {
            return '--';
        }
        
        return $numero_hojas;
    }
    
    public function displayFechaEntrega() {
        $fecha_entrega = $this->getFechaEntrega();
        if (empty($fecha_entrega)) {
            return '--';
        }
        
        return substr($fecha_entrega, 0, 10);
    }
    
    public function displayHoraEntrega() {
        $fecha_entrega = $this->getFechaEntrega();
        if (empty($fecha_entrega)) {
            return '--';
        }
        
        return substr($fecha_entrega, -8);
    }

    public function isPostulant($requerimiento) {
        $requerimientos = $this->getPostulanteRequerimientos();
        foreach ($requerimientos as $_requerimiento) {
            if ($requerimiento->requerimiento_id
                    == $_requerimiento->requerimiento_id) {
                return true;
            }
        }
        return false;
    }
    
    public function hasRequisito($requisito) {
        return true;
    }

    public function hasDocumento($documento) {
        return true;
    }

    public function __toString() {
        return str_pad($this->getApellidoPaterno(), 16)
            . str_pad($this->getApellidoMaterno(), 16)
            . str_pad($this->getNombres(), 20)
            . str_pad($this->getCi(), 13)
            . str_pad($this->getSis(), 10)
            . str_pad($this->getCorreoElectronico(), 45)
            . str_pad($this->getTelefono(), 2)
            . str_pad($this->getDireccion(), 2);
    }
}
