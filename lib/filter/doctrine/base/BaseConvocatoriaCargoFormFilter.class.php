<?php

/**
 * ConvocatoriaCargo filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaCargoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero_orden'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'numero_orden'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_cargo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaCargo';
  }

  public function getFields()
  {
    return array(
      'convocatoria_id' => 'Number',
      'cargo_id'        => 'Number',
      'numero_orden'    => 'Number',
    );
  }
}
