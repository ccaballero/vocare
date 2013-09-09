<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DocumentacionPlantilla', 'doctrine');

/**
 * BaseDocumentacionPlantilla
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $label
 * @property clob $redaction
 * @property clob $types
 * @property Doctrine_Collection $Volumenes
 * 
 * @method integer                getId()        Returns the current record's "id" value
 * @method string                 getLabel()     Returns the current record's "label" value
 * @method clob                   getRedaction() Returns the current record's "redaction" value
 * @method clob                   getTypes()     Returns the current record's "types" value
 * @method Doctrine_Collection    getVolumenes() Returns the current record's "Volumenes" collection
 * @method DocumentacionPlantilla setId()        Sets the current record's "id" value
 * @method DocumentacionPlantilla setLabel()     Sets the current record's "label" value
 * @method DocumentacionPlantilla setRedaction() Sets the current record's "redaction" value
 * @method DocumentacionPlantilla setTypes()     Sets the current record's "types" value
 * @method DocumentacionPlantilla setVolumenes() Sets the current record's "Volumenes" collection
 * 
 * @package    .
 * @subpackage model
 * @author     Carlos Eduardo Caballero Burgoa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumentacionPlantilla extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('documentacion_plantilla');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('label', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('redaction', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('types', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             'default' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('DocumentacionVolumen as Volumenes', array(
             'local' => 'id',
             'foreign' => 'template_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}