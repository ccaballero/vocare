<?php

/**
 * CargoEncargado form base class.
 *
 * @method CargoEncargado getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCargoEncargadoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'cargo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cargo'), 'add_empty' => true)),
      'encargado' => new sfWidgetFormInputText(),
      'email'     => new sfWidgetFormInputText(),
      'fecha'     => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cargo_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cargo'), 'required' => false)),
      'encargado' => new sfValidatorString(array('max_length' => 255)),
      'email'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fecha'     => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('cargo_encargado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CargoEncargado';
  }

}
