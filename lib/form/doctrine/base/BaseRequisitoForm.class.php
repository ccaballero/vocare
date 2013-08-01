<?php

/**
 * Requisito form base class.
 *
 * @method Requisito getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRequisitoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'texto'              => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'convocatorias_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria')),
      'requisito_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Postulante')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'texto'              => new sfValidatorString(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'convocatorias_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria', 'required' => false)),
      'requisito_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Postulante', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('requisito[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Requisito';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['convocatorias_list']))
    {
      $this->setDefault('convocatorias_list', $this->object->Convocatorias->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['requisito_list']))
    {
      $this->setDefault('requisito_list', $this->object->Requisito->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveConvocatoriasList($con);
    $this->saveRequisitoList($con);

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

  public function saveRequisitoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['requisito_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Requisito->getPrimaryKeys();
    $values = $this->getValue('requisito_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Requisito', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Requisito', array_values($link));
    }
  }

}
