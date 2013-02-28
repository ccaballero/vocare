<?php

/**
 * ConvocatoriaDocumento form base class.
 *
 * @method ConvocatoriaDocumento getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaDocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'convocatoria_id' => new sfWidgetFormInputHidden(),
      'documento_id'    => new sfWidgetFormInputHidden(),
      'numero_orden'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'convocatoria_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('convocatoria_id')), 'empty_value' => $this->getObject()->get('convocatoria_id'), 'required' => false)),
      'documento_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('documento_id')), 'empty_value' => $this->getObject()->get('documento_id'), 'required' => false)),
      'numero_orden'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaDocumento';
  }

}
