<?php

/**
 * Requisito filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRequisitoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'texto'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'convocatorias_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria')),
    ));

    $this->setValidators(array(
      'texto'              => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'convocatorias_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('requisito_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addConvocatoriasListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('ConvocatoriaRequisito.convocatoria_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Requisito';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'texto'              => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'convocatorias_list' => 'ManyKey',
    );
  }
}
