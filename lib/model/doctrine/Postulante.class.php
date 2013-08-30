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

    public function hasRequerimiento($requerimiento) {
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
        $requisitos = $this->getPostulanteRequisitos();
        foreach ($requisitos as $_requisito) {
            if ($requisito->requisito_id
                    == $_requisito->requisito_id) {
                return true;
            }
        }
        return false;
    }

    public function hasDocumento($documento) {
        $documentos = $this->getPostulanteDocumentos();
        foreach ($documentos as $_documento) {
            if ($documento->documento_id
                    == $_documento->documento_id) {
                return true;
            }
        }
        return false;
    }
    
    public function clearRequerimientos() {
        Doctrine_Query::create()
            ->delete('PostulanteRequerimiento pr')
            ->where('pr.postulante_id = ?', $this->getId())
            ->execute();
    }
    
    public function clearRequisitos() {
        Doctrine_Query::create()
            ->delete('PostulanteRequisito pr')
            ->where('pr.postulante_id = ?', $this->getId())
            ->execute();
    }
    
    public function clearDocumentos() {
        Doctrine_Query::create()
            ->delete('PostulanteDocumento pd')
            ->where('pd.postulante_id = ?', $this->getId())
            ->execute();
    }

//    public function __toString() {
//        return str_pad($this->getApellidoPaterno(), 16)
//            . str_pad($this->getApellidoMaterno(), 16)
//            . str_pad($this->getNombres(), 20)
//            . str_pad($this->getCi(), 13)
//            . str_pad($this->getSis(), 10)
//            . str_pad($this->getCorreoElectronico(), 45)
//            . str_pad($this->getTelefono(), 2)
//            . str_pad($this->getDireccion(), 2);
//    }
}
