<?php

/**
 * ConvocatoriaRedaccion filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaRedaccionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'convocatoria_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'add_empty' => true)),
      'numero_enmienda' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'redaccion'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'convocatoria_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Convocatoria'), 'column' => 'id')),
      'numero_enmienda' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'redaccion'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_redaccion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaRedaccion';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'convocatoria_id' => 'ForeignKey',
      'numero_enmienda' => 'Number',
      'redaccion'       => 'Text',
    );
  }
}
