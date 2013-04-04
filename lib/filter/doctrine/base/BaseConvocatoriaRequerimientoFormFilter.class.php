<?php

/**
 * ConvocatoriaRequerimiento filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaRequerimientoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero_item'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad_requerida' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'numero_item'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidad_requerida' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_requerimiento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaRequerimiento';
  }

  public function getFields()
  {
    return array(
      'convocatoria_id'    => 'Number',
      'requerimiento_id'   => 'Number',
      'numero_item'        => 'Number',
      'cantidad_requerida' => 'Number',
    );
  }
}
