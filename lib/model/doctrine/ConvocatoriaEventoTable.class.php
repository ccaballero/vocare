<?php

class ConvocatoriaEventoTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('ConvocatoriaEvento');
    }
    
    public function findByConvocatoriaAndEvento($convocatoria, $evento) {
        $q = $this->createQuery('ce')
            ->where('ce.convocatoria_id = ?', $convocatoria->getId())
            ->AndWhere('ce.evento_id = ?', $evento);
        return $q->fetchOne();
    }
}
