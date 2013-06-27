<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DocumentacionVolumen', 'doctrine');

/**
 * BaseDocumentacionVolumen
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $plantilla_id
 * @property string $nombre
 * @property clob $vars
 * @property DocumentacionPlantilla $DocumentacionPlantilla
 * @property Doctrine_Collection $Documentaciones
 * 
 * @method integer                getId()                     Returns the current record's "id" value
 * @method integer                getPlantillaId()            Returns the current record's "plantilla_id" value
 * @method string                 getNombre()                 Returns the current record's "nombre" value
 * @method clob                   getVars()                   Returns the current record's "vars" value
 * @method DocumentacionPlantilla getDocumentacionPlantilla() Returns the current record's "DocumentacionPlantilla" value
 * @method Doctrine_Collection    getDocumentaciones()        Returns the current record's "Documentaciones" collection
 * @method DocumentacionVolumen   setId()                     Sets the current record's "id" value
 * @method DocumentacionVolumen   setPlantillaId()            Sets the current record's "plantilla_id" value
 * @method DocumentacionVolumen   setNombre()                 Sets the current record's "nombre" value
 * @method DocumentacionVolumen   setVars()                   Sets the current record's "vars" value
 * @method DocumentacionVolumen   setDocumentacionPlantilla() Sets the current record's "DocumentacionPlantilla" value
 * @method DocumentacionVolumen   setDocumentaciones()        Sets the current record's "Documentaciones" collection
 * 
 * @package    .
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumentacionVolumen extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('documentacion_volumen');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('plantilla_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('vars', 'clob', null, array(
             'type' => 'clob',
             'fixed' => 0,
             'notnull' => true,
             'default' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DocumentacionPlantilla', array(
             'local' => 'plantilla_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));

        $this->hasMany('Documentacion as Documentaciones', array(
             'local' => 'id',
             'foreign' => 'volumen_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}