<?php

class RequisitoTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('Requisito');
    }

    public function queryRequisitos($convocatoria) {
        return Doctrine_Query::create()
               ->from('Requisito r')
               ->leftJoin('r.ConvocatoriaRequisitos cr')
               ->where('cr.convocatoria_id = ?', $convocatoria->getId())
               ->orderBy('cr.numero_orden ASC');
    }

    public function getRequisitos($convocatoria) {
        return $this->queryRequisitos($convocatoria)->execute();
    }
}
