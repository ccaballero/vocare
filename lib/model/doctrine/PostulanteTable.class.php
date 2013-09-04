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

    public function listStatus() {
        // TODO: Calcular automaticamente
        return array(
              0 => 'sin confirmacion',
              1 => 'pendiente',
              2 => 'inscrito',
              3 => 'inhabilitado',
              4 => 'habilitado',
        );
    }

    public function selectByFilters($convocatoria, $r, $e, $s) {
        $flag = (empty($r) ? '0' : '1')
              . (empty($e) ? '0' : '1')
              . (empty($s) ? '0' : '1');

        $_s = array();
        if (!empty($s)) {
            $available_status = Doctrine::getTable('Postulante')->listStatus();
            $_s = array();
            foreach ($s as $se) {
                $_s[] = $available_status[$se];
            }
        }

        $_r = array();
        if (!empty($r)) {
            foreach ($r as $re) {
                $_r[] = intval($re);
            }
        }

        $q = $this->_findByConvocatoria($convocatoria);

        switch ($flag) {
            case '000': // all
                return $this->findByConvocatoria($convocatoria);
            case '001': // list of status
                $q->WhereIn('p.estado', $_s);
                return $q->execute();
            case '010': // list of evaluations
                // not implemented
                return array();
            case '011': // evaluations and status
                // not implemented
                return array();
            case '100': // list of requeriments
                $q->leftJoin('p.PostulanteRequerimiento pr')
                  ->WhereIn('pr.requerimiento_id', $_r);
                return $q->execute();
            case '101': // requeriments and status
                $q->WhereIn('p.estado', $_s)
                  ->leftJoin('p.PostulanteRequerimiento pr')
                  ->WhereIn('pr.requerimiento_id', $_r);
                return $q->execute();
            case '110':
                // not implemented
                return array();
            case '111': // super filter
                // not implemented
                return array();
        }
    }
}
