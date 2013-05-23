<?php

/**
 * CargoEncargado filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCargoEncargadoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cargo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cargo'), 'add_empty' => true)),
      'encargado' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'     => new sfWidgetFormFilterInput(),
      'fecha'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'cargo_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cargo'), 'column' => 'id')),
      'encargado' => new sfValidatorPass(array('required' => false)),
      'email'     => new sfValidatorPass(array('required' => false)),
      'fecha'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('cargo_encargado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CargoEncargado';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'cargo_id'  => 'ForeignKey',
      'encargado' => 'Text',
      'email'     => 'Text',
      'fecha'     => 'Date',
    );
  }
}
