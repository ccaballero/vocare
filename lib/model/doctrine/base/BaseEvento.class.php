<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Evento', 'doctrine');

/**
 * BaseEvento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $descripcion
 * @property Doctrine_Collection $Convocatorias
 * @property Doctrine_Collection $ConvocatoriaEventos
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method string              getDescripcion()         Returns the current record's "descripcion" value
 * @method Doctrine_Collection getConvocatorias()       Returns the current record's "Convocatorias" collection
 * @method Doctrine_Collection getConvocatoriaEventos() Returns the current record's "ConvocatoriaEventos" collection
 * @method Evento              setId()                  Sets the current record's "id" value
 * @method Evento              setDescripcion()         Sets the current record's "descripcion" value
 * @method Evento              setConvocatorias()       Sets the current record's "Convocatorias" collection
 * @method Evento              setConvocatoriaEventos() Sets the current record's "ConvocatoriaEventos" collection
 * 
 * @package    .
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvento extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('evento');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('descripcion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => true,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Convocatoria as Convocatorias', array(
             'refClass' => 'ConvocatoriaEvento',
             'local' => 'evento_id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaEvento as ConvocatoriaEventos', array(
             'local' => 'id',
             'foreign' => 'evento_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}