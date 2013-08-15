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
}
