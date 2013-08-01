<?php

/**
 * PostulanteRequisito form base class.
 *
 * @method PostulanteRequisito getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostulanteRequisitoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'postulante_id' => new sfWidgetFormInputHidden(),
      'requisito_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'postulante_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('postulante_id')), 'empty_value' => $this->getObject()->get('postulante_id'), 'required' => false)),
      'requisito_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('requisito_id')), 'empty_value' => $this->getObject()->get('requisito_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('postulante_requisito[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostulanteRequisito';
  }

}
