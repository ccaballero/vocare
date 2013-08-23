<?php

class PostulanteTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('Postulante');
    }

    public function _findByConvocatoria($convocatoria) {
        return $this->createQuery('p')
            ->where('p.convocatoria_id = ?', $convocatoria->getId())
            ->addOrderBy('p.apellido_paterno ASC')
            ->addOrderBy('p.apellido_materno ASC')
            ->addOrderBy('p.nombres ASC');
    }

    public function findByConvocatoria($convocatoria) {
        $q = $this->_findByConvocatoria($convocatoria);
        return $q->execute();
    }

    public function findByConvocatoriaAndState($convocatoria, $estado) {
        $q = $this->_findByConvocatoria($convocatoria);
        $q->AndWhere('p.estado = ?', $estado);
        return $q->execute();
    }

    public function findByConfirmation($id, $hash) {
        $q = $this->createQuery('p')
            ->where('p.id = ?', $id)
            ->AndWhere('p.confirmacion = ?', sha1($hash));

        return $q->fetchOne();
    }
}
