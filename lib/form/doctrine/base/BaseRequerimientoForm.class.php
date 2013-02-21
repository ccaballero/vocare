<?php

/**
 * Requerimiento form base class.
 *
 * @method Requerimiento getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRequerimientoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'codigo'           => new sfWidgetFormInputText(),
      'nombre'           => new sfWidgetFormInputText(),
      'texto'            => new sfWidgetFormTextarea(),
      'horas_academicas' => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'codigo'           => new sfValidatorString(array('max_length' => 32)),
      'nombre'           => new sfValidatorString(array('max_length' => 128)),
      'texto'            => new sfValidatorString(),
      'horas_academicas' => new sfValidatorInteger(),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('requerimiento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Requerimiento';
  }

}
