<?php

/**
 * ConvocatoriaEvaluacion form base class.
 *
 * @method ConvocatoriaEvaluacion getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaEvaluacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'convocatoria_id' => new sfWidgetFormInputHidden(),
      'evaluacion_id'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'convocatoria_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('convocatoria_id')), 'empty_value' => $this->getObject()->get('convocatoria_id'), 'required' => false)),
      'evaluacion_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('evaluacion_id')), 'empty_value' => $this->getObject()->get('evaluacion_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_evaluacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaEvaluacion';
  }

}
