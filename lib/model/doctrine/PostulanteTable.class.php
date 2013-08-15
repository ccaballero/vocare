<?php

class PostulanteTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('Postulante');
    }
    
    public function findByConvocatoria($convocatoria) {
        $q = $this->createQuery('p')
           ->where('p.convocatoria_id = ?', $convocatoria->getId())
           ->addOrderBy('p.apellido_paterno ASC')
           ->addOrderBy('p.apellido_materno ASC')
           ->addOrderBy('p.nombres ASC');

        return $q->execute();
    }
}
