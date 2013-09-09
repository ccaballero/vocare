<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CargoEncargado', 'doctrine');

/**
 * BaseCargoEncargado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cargo_id
 * @property string $encargado
 * @property string $email
 * @property date $fecha
 * @property Cargo $Cargo
 * 
 * @method integer        getCargoId()   Returns the current record's "cargo_id" value
 * @method string         getEncargado() Returns the current record's "encargado" value
 * @method string         getEmail()     Returns the current record's "email" value
 * @method date           getFecha()     Returns the current record's "fecha" value
 * @method Cargo          getCargo()     Returns the current record's "Cargo" value
 * @method CargoEncargado setCargoId()   Sets the current record's "cargo_id" value
 * @method CargoEncargado setEncargado() Sets the current record's "encargado" value
 * @method CargoEncargado setEmail()     Sets the current record's "email" value
 * @method CargoEncargado setFecha()     Sets the current record's "fecha" value
 * @method CargoEncargado setCargo()     Sets the current record's "Cargo" value
 * 
 * @package    .
 * @subpackage model
 * @author     Carlos Eduardo Caballero Burgoa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCargoEncargado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cargo_encargado');
        $this->hasColumn('cargo_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'length' => 4,
             ));
        $this->hasColumn('encargado', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('fecha', 'date', null, array(
             'type' => 'date',
             'fixed' => 0,
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cargo', array(
             'local' => 'cargo_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));
    }
}