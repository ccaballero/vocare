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
 * @property Doctrine_Collection $Convocatorias
 * @property Doctrine_Collection $ConvocatoriaDocumentos
 * @property Doctrine_Collection $Postulantes
 * @property Doctrine_Collection $PostulanteDocumentos
 * 
 * @method integer             getId()                     Returns the current record's "id" value
 * @method string              getTexto()                  Returns the current record's "texto" value
 * @method Doctrine_Collection getConvocatorias()          Returns the current record's "Convocatorias" collection
 * @method Doctrine_Collection getConvocatoriaDocumentos() Returns the current record's "ConvocatoriaDocumentos" collection
 * @method Doctrine_Collection getPostulantes()            Returns the current record's "Postulantes" collection
 * @method Doctrine_Collection getPostulanteDocumentos()   Returns the current record's "PostulanteDocumentos" collection
 * @method Documento           setId()                     Sets the current record's "id" value
 * @method Documento           setTexto()                  Sets the current record's "texto" value
 * @method Documento           setConvocatorias()          Sets the current record's "Convocatorias" collection
 * @method Documento           setConvocatoriaDocumentos() Sets the current record's "ConvocatoriaDocumentos" collection
 * @method Documento           setPostulantes()            Sets the current record's "Postulantes" collection
 * @method Documento           setPostulanteDocumentos()   Sets the current record's "PostulanteDocumentos" collection
 * 
 * @package    .
 * @subpackage model
 * @author     Carlos Eduardo Caballero Burgoa
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
        $this->hasMany('Convocatoria as Convocatorias', array(
             'refClass' => 'ConvocatoriaDocumento',
             'local' => 'documento_id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaDocumento as ConvocatoriaDocumentos', array(
             'local' => 'id',
             'foreign' => 'documento_id'));

        $this->hasMany('Postulante as Postulantes', array(
             'refClass' => 'PostulanteDocumento',
             'local' => 'documento_id',
             'foreign' => 'postulante_id'));

        $this->hasMany('PostulanteDocumento as PostulanteDocumentos', array(
             'local' => 'id',
             'foreign' => 'documento_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}