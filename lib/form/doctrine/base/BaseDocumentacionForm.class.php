<?php

/**
 * Documentacion form base class.
 *
 * @method Documentacion getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'template_id' => new sfWidgetFormInputHidden(),
      'volumen_id'  => new sfWidgetFormInputHidden(),
      'vars'        => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'template_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('template_id')), 'empty_value' => $this->getObject()->get('template_id'), 'required' => false)),
      'volumen_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('volumen_id')), 'empty_value' => $this->getObject()->get('volumen_id'), 'required' => false)),
      'vars'        => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('documentacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentacion';
  }

}
