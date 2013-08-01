<?php
$c = 0;
/**
 * ConvocatoriaRequerimientoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ConvocatoriaRequerimientoTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ConvocatoriaRequerimientoTable
     */
    
    public static function getInstance() {
        return Doctrine_Core::getTable('ConvocatoriaRequerimiento');
    }

    public function getRequerimientos() {
        global $c;
        $q = Doctrine_Query::create()
                ->from('Requerimiento r')
                ->innerJoin('r.ConvocatoriaRequerimiento cr')
                ->where('cr.convocatoria_id = ?', $c);
        return $q->execute();
    }
}
