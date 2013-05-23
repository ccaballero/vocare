<?php

/**
 * ConvocatoriaNotificacion form base class.
 *
 * @method ConvocatoriaNotificacion getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaNotificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'convocatoria_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'add_empty' => true)),
      'cargo'           => new sfWidgetFormInputText(),
      'encargado'       => new sfWidgetFormInputText(),
      'email'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'convocatoria_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'required' => false)),
      'cargo'           => new sfValidatorString(array('max_length' => 255)),
      'encargado'       => new sfValidatorString(array('max_length' => 255)),
      'email'           => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_notificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaNotificacion';
  }

}
