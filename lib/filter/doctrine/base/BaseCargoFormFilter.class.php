<?php

/**
 * Cargo filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCargoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cargo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'convocatorias_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria')),
    ));

    $this->setValidators(array(
      'cargo'              => new sfValidatorPass(array('required' => false)),
      'convocatorias_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cargo_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.ConvocatoriaCargo ConvocatoriaCargo')
      ->andWhereIn('ConvocatoriaCargo.convocatoria_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Cargo';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'cargo'              => 'Text',
      'convocatorias_list' => 'ManyKey',
    );
  }
}
