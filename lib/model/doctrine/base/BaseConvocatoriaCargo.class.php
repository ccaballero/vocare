<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ConvocatoriaCargo', 'doctrine');

/**
 * BaseConvocatoriaCargo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $convocatoria_id
 * @property integer $cargo_id
 * @property integer $numero_orden
 * @property Convocatoria $Convocatoria
 * @property Cargo $Cargo
 * 
 * @method integer           getConvocatoriaId()  Returns the current record's "convocatoria_id" value
 * @method integer           getCargoId()         Returns the current record's "cargo_id" value
 * @method integer           getNumeroOrden()     Returns the current record's "numero_orden" value
 * @method Convocatoria      getConvocatoria()    Returns the current record's "Convocatoria" value
 * @method Cargo             getCargo()           Returns the current record's "Cargo" value
 * @method ConvocatoriaCargo setConvocatoriaId()  Sets the current record's "convocatoria_id" value
 * @method ConvocatoriaCargo setCargoId()         Sets the current record's "cargo_id" value
 * @method ConvocatoriaCargo setNumeroOrden()     Sets the current record's "numero_orden" value
 * @method ConvocatoriaCargo setConvocatoria()    Sets the current record's "Convocatoria" value
 * @method ConvocatoriaCargo setCargo()           Sets the current record's "Cargo" value
 * 
 * @package    .
 * @subpackage model
 * @author     Carlos Eduardo Caballero Burgoa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConvocatoriaCargo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('convocatoria_cargo');
        $this->hasColumn('convocatoria_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('cargo_id', 'integer', 4, array(
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

        $this->hasOne('Cargo', array(
             'local' => 'cargo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}