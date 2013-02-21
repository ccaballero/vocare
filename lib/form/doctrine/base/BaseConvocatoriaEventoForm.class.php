<?php

/**
 * ConvocatoriaEvento form base class.
 *
 * @method ConvocatoriaEvento getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaEventoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'convocatoria_id' => new sfWidgetFormInputHidden(),
      'evento_id'       => new sfWidgetFormInputHidden(),
      'fecha'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'convocatoria_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('convocatoria_id')), 'empty_value' => $this->getObject()->get('convocatoria_id'), 'required' => false)),
      'evento_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('evento_id')), 'empty_value' => $this->getObject()->get('evento_id'), 'required' => false)),
      'fecha'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaEvento';
  }

}
