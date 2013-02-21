<?php

/**
 * ConvocatoriaRequisito form base class.
 *
 * @method ConvocatoriaRequisito getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaRequisitoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'convocatoria_id' => new sfWidgetFormInputHidden(),
      'requisito_id'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'convocatoria_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('convocatoria_id')), 'empty_value' => $this->getObject()->get('convocatoria_id'), 'required' => false)),
      'requisito_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('requisito_id')), 'empty_value' => $this->getObject()->get('requisito_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_requisito[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaRequisito';
  }

}
