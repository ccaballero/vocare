<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DocumentacionVolumen', 'doctrine');

/**
 * BaseDocumentacionVolumen
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $template_id
 * @property string $label
 * @property clob $vars
 * @property Doctrine_Collection $Documents
 * @property DocumentacionPlantilla $DocumentacionPlantilla
 * 
 * @method integer                getId()                     Returns the current record's "id" value
 * @method integer                getTemplateId()             Returns the current record's "template_id" value
 * @method string                 getLabel()                  Returns the current record's "label" value
 * @method clob                   getVars()                   Returns the current record's "vars" value
 * @method Doctrine_Collection    getDocuments()              Returns the current record's "Documents" collection
 * @method DocumentacionPlantilla getDocumentacionPlantilla() Returns the current record's "DocumentacionPlantilla" value
 * @method DocumentacionVolumen   setId()                     Sets the current record's "id" value
 * @method DocumentacionVolumen   setTemplateId()             Sets the current record's "template_id" value
 * @method DocumentacionVolumen   setLabel()                  Sets the current record's "label" value
 * @method DocumentacionVolumen   setVars()                   Sets the current record's "vars" value
 * @method DocumentacionVolumen   setDocuments()              Sets the current record's "Documents" collection
 * @method DocumentacionVolumen   setDocumentacionPlantilla() Sets the current record's "DocumentacionPlantilla" value
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
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('template_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('label', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('vars', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             'default' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Documentacion as Documents', array(
             'local' => 'id',
             'foreign' => 'volumen_id'));

        $this->hasOne('DocumentacionPlantilla', array(
             'local' => 'template_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}