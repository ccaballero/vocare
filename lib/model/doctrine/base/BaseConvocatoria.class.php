<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Convocatoria', 'doctrine');

/**
 * BaseConvocatoria
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $gestion
 * @property enum $estado
 * @property date $publicacion
 * @property Doctrine_Collection $Redacciones
 * @property Doctrine_Collection $Requerimientos
 * @property Doctrine_Collection $Requisitos
 * @property Doctrine_Collection $Documentos
 * @property Doctrine_Collection $Eventos
 * @property Doctrine_Collection $Evaluaciones
 * @property Doctrine_Collection $Cargos
 * @property Doctrine_Collection $Notificaciones
 * @property Doctrine_Collection $Postulantes
 * @property Doctrine_Collection $ConvocatoriaRequerimientos
 * @property Doctrine_Collection $ConvocatoriaRequisitos
 * @property Doctrine_Collection $ConvocatoriaDocumentos
 * @property Doctrine_Collection $ConvocatoriaEventos
 * @property Doctrine_Collection $ConvocatoriaEvaluaciones
 * @property Doctrine_Collection $ConvocatoriaRequerimientoEvaluaciones
 * @property Doctrine_Collection $ConvocatoriaCargos
 * @property Doctrine_Collection $UsuarioGrupoConvocatoria
 * 
 * @method integer             getId()                                    Returns the current record's "id" value
 * @method string              getGestion()                               Returns the current record's "gestion" value
 * @method enum                getEstado()                                Returns the current record's "estado" value
 * @method date                getPublicacion()                           Returns the current record's "publicacion" value
 * @method Doctrine_Collection getRedacciones()                           Returns the current record's "Redacciones" collection
 * @method Doctrine_Collection getRequerimientos()                        Returns the current record's "Requerimientos" collection
 * @method Doctrine_Collection getRequisitos()                            Returns the current record's "Requisitos" collection
 * @method Doctrine_Collection getDocumentos()                            Returns the current record's "Documentos" collection
 * @method Doctrine_Collection getEventos()                               Returns the current record's "Eventos" collection
 * @method Doctrine_Collection getEvaluaciones()                          Returns the current record's "Evaluaciones" collection
 * @method Doctrine_Collection getCargos()                                Returns the current record's "Cargos" collection
 * @method Doctrine_Collection getNotificaciones()                        Returns the current record's "Notificaciones" collection
 * @method Doctrine_Collection getPostulantes()                           Returns the current record's "Postulantes" collection
 * @method Doctrine_Collection getConvocatoriaRequerimientos()            Returns the current record's "ConvocatoriaRequerimientos" collection
 * @method Doctrine_Collection getConvocatoriaRequisitos()                Returns the current record's "ConvocatoriaRequisitos" collection
 * @method Doctrine_Collection getConvocatoriaDocumentos()                Returns the current record's "ConvocatoriaDocumentos" collection
 * @method Doctrine_Collection getConvocatoriaEventos()                   Returns the current record's "ConvocatoriaEventos" collection
 * @method Doctrine_Collection getConvocatoriaEvaluaciones()              Returns the current record's "ConvocatoriaEvaluaciones" collection
 * @method Doctrine_Collection getConvocatoriaRequerimientoEvaluaciones() Returns the current record's "ConvocatoriaRequerimientoEvaluaciones" collection
 * @method Doctrine_Collection getConvocatoriaCargos()                    Returns the current record's "ConvocatoriaCargos" collection
 * @method Doctrine_Collection getUsuarioGrupoConvocatoria()              Returns the current record's "UsuarioGrupoConvocatoria" collection
 * @method Convocatoria        setId()                                    Sets the current record's "id" value
 * @method Convocatoria        setGestion()                               Sets the current record's "gestion" value
 * @method Convocatoria        setEstado()                                Sets the current record's "estado" value
 * @method Convocatoria        setPublicacion()                           Sets the current record's "publicacion" value
 * @method Convocatoria        setRedacciones()                           Sets the current record's "Redacciones" collection
 * @method Convocatoria        setRequerimientos()                        Sets the current record's "Requerimientos" collection
 * @method Convocatoria        setRequisitos()                            Sets the current record's "Requisitos" collection
 * @method Convocatoria        setDocumentos()                            Sets the current record's "Documentos" collection
 * @method Convocatoria        setEventos()                               Sets the current record's "Eventos" collection
 * @method Convocatoria        setEvaluaciones()                          Sets the current record's "Evaluaciones" collection
 * @method Convocatoria        setCargos()                                Sets the current record's "Cargos" collection
 * @method Convocatoria        setNotificaciones()                        Sets the current record's "Notificaciones" collection
 * @method Convocatoria        setPostulantes()                           Sets the current record's "Postulantes" collection
 * @method Convocatoria        setConvocatoriaRequerimientos()            Sets the current record's "ConvocatoriaRequerimientos" collection
 * @method Convocatoria        setConvocatoriaRequisitos()                Sets the current record's "ConvocatoriaRequisitos" collection
 * @method Convocatoria        setConvocatoriaDocumentos()                Sets the current record's "ConvocatoriaDocumentos" collection
 * @method Convocatoria        setConvocatoriaEventos()                   Sets the current record's "ConvocatoriaEventos" collection
 * @method Convocatoria        setConvocatoriaEvaluaciones()              Sets the current record's "ConvocatoriaEvaluaciones" collection
 * @method Convocatoria        setConvocatoriaRequerimientoEvaluaciones() Sets the current record's "ConvocatoriaRequerimientoEvaluaciones" collection
 * @method Convocatoria        setConvocatoriaCargos()                    Sets the current record's "ConvocatoriaCargos" collection
 * @method Convocatoria        setUsuarioGrupoConvocatoria()              Sets the current record's "UsuarioGrupoConvocatoria" collection
 * 
 * @package    .
 * @subpackage model
 * @author     Carlos Eduardo Caballero Burgoa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConvocatoria extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('convocatoria');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('gestion', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('estado', 'enum', 10, array(
             'type' => 'enum',
             'fixed' => 0,
             'values' => 
             array(
              0 => 'borrador',
              1 => 'emitido',
              2 => 'anulado',
              3 => 'vigente',
              4 => 'finalizado',
              5 => 'eliminado',
             ),
             'default' => 'borrador',
             'notnull' => true,
             'length' => 10,
             ));
        $this->hasColumn('publicacion', 'date', null, array(
             'type' => 'date',
             'fixed' => 0,
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ConvocatoriaRedaccion as Redacciones', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('Requerimiento as Requerimientos', array(
             'refClass' => 'ConvocatoriaRequerimiento',
             'local' => 'convocatoria_id',
             'foreign' => 'requerimiento_id'));

        $this->hasMany('Requisito as Requisitos', array(
             'refClass' => 'ConvocatoriaRequisito',
             'local' => 'convocatoria_id',
             'foreign' => 'requisito_id'));

        $this->hasMany('Documento as Documentos', array(
             'refClass' => 'ConvocatoriaDocumento',
             'local' => 'convocatoria_id',
             'foreign' => 'documento_id'));

        $this->hasMany('Evento as Eventos', array(
             'refClass' => 'ConvocatoriaEvento',
             'local' => 'convocatoria_id',
             'foreign' => 'evento_id'));

        $this->hasMany('Evaluacion as Evaluaciones', array(
             'refClass' => 'ConvocatoriaEvaluacion',
             'local' => 'convocatoria_id',
             'foreign' => 'evaluacion_id'));

        $this->hasMany('Cargo as Cargos', array(
             'refClass' => 'ConvocatoriaCargo',
             'local' => 'convocatoria_id',
             'foreign' => 'cargo_id'));

        $this->hasMany('ConvocatoriaNotificacion as Notificaciones', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('Postulante as Postulantes', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaRequerimiento as ConvocatoriaRequerimientos', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaRequisito as ConvocatoriaRequisitos', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaDocumento as ConvocatoriaDocumentos', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaEvento as ConvocatoriaEventos', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaEvaluacion as ConvocatoriaEvaluaciones', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaRequerimientoEvaluacion as ConvocatoriaRequerimientoEvaluaciones', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('ConvocatoriaCargo as ConvocatoriaCargos', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $this->hasMany('UsuarioGrupoConvocatoria', array(
             'local' => 'id',
             'foreign' => 'convocatoria_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}