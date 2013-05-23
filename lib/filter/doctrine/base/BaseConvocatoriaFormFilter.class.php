<?php

/**
 * Convocatoria filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gestion'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estado'              => new sfWidgetFormChoice(array('choices' => array('' => '', 'borrador' => 'borrador', 'emitido' => 'emitido', 'anulado' => 'anulado', 'vigente' => 'vigente', 'finalizado' => 'finalizado', 'eliminado' => 'eliminado'))),
      'publicacion'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'requerimientos_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento')),
      'requisitos_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requisito')),
      'documentos_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Documento')),
      'eventos_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Evento')),
      'evaluaciones_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Evaluacion')),
      'cargos_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Cargo')),
    ));

    $this->setValidators(array(
      'gestion'             => new sfValidatorPass(array('required' => false)),
      'estado'              => new sfValidatorChoice(array('required' => false, 'choices' => array('borrador' => 'borrador', 'emitido' => 'emitido', 'anulado' => 'anulado', 'vigente' => 'vigente', 'finalizado' => 'finalizado', 'eliminado' => 'eliminado'))),
      'publicacion'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'requerimientos_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento', 'required' => false)),
      'requisitos_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requisito', 'required' => false)),
      'documentos_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Documento', 'required' => false)),
      'eventos_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Evento', 'required' => false)),
      'evaluaciones_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Evaluacion', 'required' => false)),
      'cargos_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Cargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addRequerimientosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ConvocatoriaRequerimiento ConvocatoriaRequerimiento')
      ->andWhereIn('ConvocatoriaRequerimiento.requerimiento_id', $values)
    ;
  }

  public function addRequisitosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ConvocatoriaRequisito ConvocatoriaRequisito')
      ->andWhereIn('ConvocatoriaRequisito.requisito_id', $values)
    ;
  }

  public function addDocumentosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ConvocatoriaDocumento ConvocatoriaDocumento')
      ->andWhereIn('ConvocatoriaDocumento.documento_id', $values)
    ;
  }

  public function addEventosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ConvocatoriaEvento ConvocatoriaEvento')
      ->andWhereIn('ConvocatoriaEvento.evento_id', $values)
    ;
  }

  public function addEvaluacionesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ConvocatoriaEvaluacion ConvocatoriaEvaluacion')
      ->andWhereIn('ConvocatoriaEvaluacion.evaluacion_id', $values)
    ;
  }

  public function addCargosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ConvocatoriaCargo ConvocatoriaCargo')
      ->andWhereIn('ConvocatoriaCargo.cargo_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Convocatoria';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'gestion'             => 'Text',
      'estado'              => 'Enum',
      'publicacion'         => 'Date',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'requerimientos_list' => 'ManyKey',
      'requisitos_list'     => 'ManyKey',
      'documentos_list'     => 'ManyKey',
      'eventos_list'        => 'ManyKey',
      'evaluaciones_list'   => 'ManyKey',
      'cargos_list'         => 'ManyKey',
    );
  }
}
