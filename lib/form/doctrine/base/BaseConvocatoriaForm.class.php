<?php

/**
 * Convocatoria form base class.
 *
 * @method Convocatoria getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'estado'     => new sfWidgetFormChoice(array('choices' => array('borrador' => 'borrador', 'emitido' => 'emitido', 'anulado' => 'anulado', 'vigente' => 'vigente', 'finalizado' => 'finalizado', 'eliminado' => 'eliminado'))),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 255)),
      'estado'     => new sfValidatorChoice(array('choices' => array(0 => 'borrador', 1 => 'emitido', 2 => 'anulado', 3 => 'vigente', 4 => 'finalizado', 5 => 'eliminado'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('convocatoria[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Convocatoria';
  }

}
