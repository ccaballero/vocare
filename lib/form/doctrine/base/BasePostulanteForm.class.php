<?php

/**
 * Postulante form base class.
 *
 * @method Postulante getObject() Returns the current form's model object
 *
 * @package    .
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostulanteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'convocatoria_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'add_empty' => true)),
      'nombre'             => new sfWidgetFormInputText(),
      'apellido_paterno'   => new sfWidgetFormInputText(),
      'apellido_materno'   => new sfWidgetFormInputText(),
      'ci'                 => new sfWidgetFormInputText(),
      'cod_sis'            => new sfWidgetFormInputText(),
      'email'              => new sfWidgetFormInputText(),
      'telefono'           => new sfWidgetFormInputText(),
      'direccion'          => new sfWidgetFormInputText(),
      'numero_hojas'       => new sfWidgetFormInputText(),
      'estado'             => new sfWidgetFormChoice(array('choices' => array('Pendiente' => 'Pendiente', 'Inscrito' => 'Inscrito', 'Inhabilitado' => 'Inhabilitado', 'Habilitado' => 'Habilitado'))),
      'observacion'        => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'requerimiento_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento')),
      'requisito_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requisito')),
      'documento_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Documento')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'convocatoria_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'apellido_paterno'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'apellido_materno'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'ci'                 => new sfValidatorInteger(array('required' => false)),
      'cod_sis'            => new sfValidatorInteger(array('required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 255)),
      'telefono'           => new sfValidatorInteger(array('required' => false)),
      'direccion'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'numero_hojas'       => new sfValidatorInteger(array('required' => false)),
      'estado'             => new sfValidatorChoice(array('choices' => array(0 => 'Pendiente', 1 => 'Inscrito', 2 => 'Inhabilitado', 3 => 'Habilitado'), 'required' => false)),
      'observacion'        => new sfValidatorString(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'requerimiento_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento', 'required' => false)),
      'requisito_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requisito', 'required' => false)),
      'documento_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Documento', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Postulante', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('postulante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Postulante';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['requerimiento_list']))
    {
      $this->setDefault('requerimiento_list', $this->object->Requerimiento->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['requisito_list']))
    {
      $this->setDefault('requisito_list', $this->object->Requisito->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['documento_list']))
    {
      $this->setDefault('documento_list', $this->object->Documento->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveRequerimientoList($con);
    $this->saveRequisitoList($con);
    $this->saveDocumentoList($con);

    parent::doSave($con);
  }

  public function saveRequerimientoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['requerimiento_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Requerimiento->getPrimaryKeys();
    $values = $this->getValue('requerimiento_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Requerimiento', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Requerimiento', array_values($link));
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

  public function saveDocumentoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['documento_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Documento->getPrimaryKeys();
    $values = $this->getValue('documento_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Documento', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Documento', array_values($link));
    }
  }

}
