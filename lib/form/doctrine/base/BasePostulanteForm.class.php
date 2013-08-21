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
      'id'                  => new sfWidgetFormInputHidden(),
      'convocatoria_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'add_empty' => true)),
      'apellido_paterno'    => new sfWidgetFormInputText(),
      'apellido_materno'    => new sfWidgetFormInputText(),
      'nombres'             => new sfWidgetFormInputText(),
      'ci'                  => new sfWidgetFormInputText(),
      'sis'                 => new sfWidgetFormInputText(),
      'correo_electronico'  => new sfWidgetFormInputText(),
      'telefono'            => new sfWidgetFormInputText(),
      'direccion'           => new sfWidgetFormInputText(),
      'numero_hojas'        => new sfWidgetFormInputText(),
      'fecha_entrega'       => new sfWidgetFormInputText(),
      'estado'              => new sfWidgetFormChoice(array('choices' => array('pendiente' => 'pendiente', 'inscrito' => 'inscrito', 'inhabilitado' => 'inhabilitado', 'habilitado' => 'habilitado'))),
      'observacion'         => new sfWidgetFormTextarea(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'requerimientos_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento')),
      'requisitos_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requisito')),
      'documentos_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Documento')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'convocatoria_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'required' => false)),
      'apellido_paterno'    => new sfValidatorString(array('max_length' => 32)),
      'apellido_materno'    => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'nombres'             => new sfValidatorString(array('max_length' => 32)),
      'ci'                  => new sfValidatorString(array('max_length' => 16)),
      'sis'                 => new sfValidatorString(array('max_length' => 9)),
      'correo_electronico'  => new sfValidatorString(array('max_length' => 255)),
      'telefono'            => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'direccion'           => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'numero_hojas'        => new sfValidatorInteger(array('required' => false)),
      'fecha_entrega'       => new sfValidatorPass(array('required' => false)),
      'estado'              => new sfValidatorChoice(array('choices' => array(0 => 'pendiente', 1 => 'inscrito', 2 => 'inhabilitado', 3 => 'habilitado'), 'required' => false)),
      'observacion'         => new sfValidatorString(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'requerimientos_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento', 'required' => false)),
      'requisitos_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requisito', 'required' => false)),
      'documentos_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Documento', 'required' => false)),
    ));

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

    if (isset($this->widgetSchema['requerimientos_list']))
    {
      $this->setDefault('requerimientos_list', $this->object->Requerimientos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['requisitos_list']))
    {
      $this->setDefault('requisitos_list', $this->object->Requisitos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['documentos_list']))
    {
      $this->setDefault('documentos_list', $this->object->Documentos->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveRequerimientosList($con);
    $this->saveRequisitosList($con);
    $this->saveDocumentosList($con);

    parent::doSave($con);
  }

  public function saveRequerimientosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['requerimientos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Requerimientos->getPrimaryKeys();
    $values = $this->getValue('requerimientos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Requerimientos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Requerimientos', array_values($link));
    }
  }

  public function saveRequisitosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['requisitos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Requisitos->getPrimaryKeys();
    $values = $this->getValue('requisitos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Requisitos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Requisitos', array_values($link));
    }
  }

  public function saveDocumentosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['documentos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Documentos->getPrimaryKeys();
    $values = $this->getValue('documentos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Documentos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Documentos', array_values($link));
    }
  }

}
