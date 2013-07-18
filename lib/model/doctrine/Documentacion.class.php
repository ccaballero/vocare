<?php

class Documentacion extends BaseDocumentacion
{
    public function getObjectVars() {
        return json_decode($this->getVars());
    }

    public function getByIdAndVolumen($id, $volumen) {
        $q = Doctrine_Core::getTable('Documentacion')
           ->createQuery('d')
           ->where('d.id = ?', $id)
           ->andWhere('d.volumen_id = ?', $volumen);

        return $q->fetchOne();
    }
}
