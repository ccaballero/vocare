<?php

/**
 * Evento form base class.
 *
 * @method Evento getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nombre'             => new sfWidgetFormInputText(),
      'descripcion'        => new sfWidgetFormTextarea(),
      'tasks'              => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'convocatorias_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 255)),
      'descripcion'        => new sfValidatorString(array('required' => false)),
      'tasks'              => new sfValidatorString(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'convocatorias_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Evento';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['convocatorias_list']))
    {
      $this->setDefault('convocatorias_list', $this->object->Convocatorias->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveConvocatoriasList($con);

    parent::doSave($con);
  }

  public function saveConvocatoriasList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['convocatorias_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Convocatorias->getPrimaryKeys();
    $values = $this->getValue('convocatorias_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Convocatorias', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Convocatorias', array_values($link));
    }
  }

}
