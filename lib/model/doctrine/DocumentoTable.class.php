<?php

class DocumentoTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('Documento');
    }

    public function queryDocumentos($convocatoria) {
        return Doctrine_Query::create()
               ->from('Documento r')
               ->leftJoin('r.ConvocatoriaDocumentos cr')
               ->where('cr.convocatoria_id = ?', $convocatoria->getId())
               ->orderBy('cr.numero_orden ASC');
    }

    public function getDocumentos($convocatoria) {
        return $this->queryDocumentos($convocatoria)->execute();
    }
}
