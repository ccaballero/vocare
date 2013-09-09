<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ConvocatoriaRequisito', 'doctrine');

/**
 * BaseConvocatoriaRequisito
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $convocatoria_id
 * @property integer $requisito_id
 * @property integer $numero_orden
 * @property Convocatoria $Convocatoria
 * @property Requisito $Requisito
 * 
 * @method integer               getConvocatoriaId()  Returns the current record's "convocatoria_id" value
 * @method integer               getRequisitoId()     Returns the current record's "requisito_id" value
 * @method integer               getNumeroOrden()     Returns the current record's "numero_orden" value
 * @method Convocatoria          getConvocatoria()    Returns the current record's "Convocatoria" value
 * @method Requisito             getRequisito()       Returns the current record's "Requisito" value
 * @method ConvocatoriaRequisito setConvocatoriaId()  Sets the current record's "convocatoria_id" value
 * @method ConvocatoriaRequisito setRequisitoId()     Sets the current record's "requisito_id" value
 * @method ConvocatoriaRequisito setNumeroOrden()     Sets the current record's "numero_orden" value
 * @method ConvocatoriaRequisito setConvocatoria()    Sets the current record's "Convocatoria" value
 * @method ConvocatoriaRequisito setRequisito()       Sets the current record's "Requisito" value
 * 
 * @package    .
 * @subpackage model
 * @author     Carlos Eduardo Caballero Burgoa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConvocatoriaRequisito extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('convocatoria_requisito');
        $this->hasColumn('convocatoria_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('requisito_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('numero_orden', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Convocatoria', array(
             'local' => 'convocatoria_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Requisito', array(
             'local' => 'requisito_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}