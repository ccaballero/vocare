<?php

class RequerimientoTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('Requerimiento');
    }
    
    public function findByCodigo($codigo) {
        $q = $this->createQuery('r')
           ->where('r.codigo = ?', $codigo);

        return $q->fetchOne();
    }
    
    public function queryRequerimientos($convocatoria) {
        return Doctrine_Query::create()
               ->from('Requerimiento r')
               ->leftJoin('r.ConvocatoriaRequerimientos cr')
               ->where('cr.convocatoria_id = ?', $convocatoria->getId())
               ->orderBy('cr.numero_item ASC');
    }
}
