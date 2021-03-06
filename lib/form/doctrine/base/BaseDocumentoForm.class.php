<?php

/**
 * Documento form base class.
 *
 * @method Documento getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'texto'              => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'convocatorias_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria')),
      'postulantes_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Postulante')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'texto'              => new sfValidatorString(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'convocatorias_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Convocatoria', 'required' => false)),
      'postulantes_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Postulante', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documento';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['convocatorias_list']))
    {
      $this->setDefault('convocatorias_list', $this->object->Convocatorias->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['postulantes_list']))
    {
      $this->setDefault('postulantes_list', $this->object->Postulantes->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveConvocatoriasList($con);
    $this->savePostulantesList($con);

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

  public function savePostulantesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['postulantes_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Postulantes->getPrimaryKeys();
    $values = $this->getValue('postulantes_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Postulantes', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Postulantes', array_values($link));
    }
  }

}
