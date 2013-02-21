<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Documento', 'doctrine');

/**
 * BaseDocumento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $texto
 * 
 * @method integer   getId()    Returns the current record's "id" value
 * @method string    getTexto() Returns the current record's "texto" value
 * @method Documento setId()    Sets the current record's "id" value
 * @method Documento setTexto() Sets the current record's "texto" value
 * 
 * @package    .
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumento extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('documento');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('texto', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => true,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}