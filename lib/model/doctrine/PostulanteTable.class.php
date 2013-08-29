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
        if (is_array($estado)) {
            $q->WhereIn('p.estado', $estado);
        } else {
            $q->AndWhere('p.estado = ?', $estado);
        }
        return $q->execute();
    }

    public function findByConvocatoriaAndPostulante($convocatoria,
            $apellido_paterno, $apellido_materno, $nombres) {
        $q = $this->createQuery('p')
                  ->where('p.convocatoria_id = ?', $convocatoria->getId())
                  ->AndWhere('p.apellido_paterno = ?', $apellido_paterno)
                  ->AndWhere('p.apellido_materno = ?', $apellido_materno)
                  ->AndWhere('p.nombres = ?', $nombres);
        return $q->fetchOne();
    }

    public function findByConfirmation($id, $hash) {
        $q = $this->createQuery('p')
            ->where('p.id = ?', $id)
            ->AndWhere('p.confirmacion = ?', sha1($hash));

        return $q->fetchOne();
    }
}
