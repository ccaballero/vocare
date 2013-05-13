<?php

/**
 * ConvocatoriaRedaccion form base class.
 *
 * @method ConvocatoriaRedaccion getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaRedaccionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'convocatoria_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'add_empty' => true)),
      'numero_enmienda' => new sfWidgetFormInputText(),
      'redaccion'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'convocatoria_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'required' => false)),
      'numero_enmienda' => new sfValidatorInteger(array('required' => false)),
      'redaccion'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_redaccion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaRedaccion';
  }

}
