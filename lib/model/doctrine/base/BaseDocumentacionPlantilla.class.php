<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DocumentacionPlantilla', 'doctrine');

/**
 * BaseDocumentacionPlantilla
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property clob $redaccion
 * @property clob $types
 * @property Doctrine_Collection $Documentacion
 * 
 * @method integer                getId()                     Returns the current record's "id" value
 * @method string                 getNombre()                 Returns the current record's "nombre" value
 * @method clob                   getRedaccion()              Returns the current record's "redaccion" value
 * @method clob                   getTypes()                  Returns the current record's "types" value
 * @method Doctrine_Collection    getDocumentacionVolumenes() Returns the current record's "DocumentacionVolumenes" collection
 * @method Doctrine_Collection    getDocumentacion()          Returns the current record's "Documentacion" collection
 * @method DocumentacionPlantilla setId()                     Sets the current record's "id" value
 * @method DocumentacionPlantilla setNombre()                 Sets the current record's "nombre" value
 * @method DocumentacionPlantilla setRedaccion()              Sets the current record's "redaccion" value
 * @method DocumentacionPlantilla setTypes()                  Sets the current record's "types" value
 * @method DocumentacionPlantilla setDocumentacionVolumenes() Sets the current record's "DocumentacionVolumenes" collection
 * @method DocumentacionPlantilla setDocumentacion()          Sets the current record's "Documentacion" collectionVolumenes
 * @property Doctrine_Collection $Documentacion
 * 
 * @method integer                getId()                     Returns the current record's "id" value
 * @method string                 getNombre()                 Returns the current record's "nombre" value
 * @method clob                   getRedaccion()              Returns the current record's "redaccion" value
 * @method clob                   getTypes()                  Returns the current record's "types" value
 * @method Doctrine_Collection    getDocumentacionVolumenes() Returns the current record's "DocumentacionVolumenes" collection
 * @method Doctrine_Collection    getDocumentacion()          Returns the current record's "Documentacion" collection
 * @method DocumentacionPlantilla setId()                     Sets the current record's "id" value
 * @method DocumentacionPlantilla setNombre()                 Sets the current record's "nombre" value
 * @method DocumentacionPlantilla setRedaccion()              Sets the current record's "redaccion" value
 * @method DocumentacionPlantilla setTypes()                  Sets the current record's "types" value
 * @method DocumentacionPlantilla setDocumentacionVolumenes() Sets the current record's "DocumentacionVolumenes" collection
 * @method DocumentacionPlantilla setDocumentacion()          Sets the current record's "Documentacion" collection
 * 
 * @package    .
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumentacionPlantilla extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('documentacion_plantilla');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('redaccion', 'clob', null, array(
             'type' => 'clob',
             'fixed' => 0,
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('types', 'clob', null, array(
             'type' => 'clob',
             'fixed' => 0,
             'notnull' => true,
             'default' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('DocumentacionVolumen as DocumentacionVolumenes', array(
             'local' => 'id',
             'foreign' => 'plantilla_id'));

        $this->hasMany('Documentacion', array(
             'local' => 'id',
             'foreign' => 'plantilla_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}