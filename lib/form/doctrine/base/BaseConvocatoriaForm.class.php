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
      'id'                  => new sfWidgetFormInputHidden(),
      'gestion'             => new sfWidgetFormInputText(),
      'estado'              => new sfWidgetFormChoice(array('choices' => array('borrador' => 'borrador', 'emitido' => 'emitido', 'anulado' => 'anulado', 'vigente' => 'vigente', 'finalizado' => 'finalizado', 'eliminado' => 'eliminado'))),
      'publicacion'         => new sfWidgetFormDate(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'requerimientos_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento')),
      'requisitos_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Requisito')),
      'documentos_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Documento')),
      'eventos_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Evento')),
      'evaluaciones_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Evaluacion')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'gestion'             => new sfValidatorString(array('max_length' => 255)),
      'estado'              => new sfValidatorChoice(array('choices' => array(0 => 'borrador', 1 => 'emitido', 2 => 'anulado', 3 => 'vigente', 4 => 'finalizado', 5 => 'eliminado'), 'required' => false)),
      'publicacion'         => new sfValidatorDate(),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'requerimientos_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requerimiento', 'required' => false)),
      'requisitos_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Requisito', 'required' => false)),
      'documentos_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Documento', 'required' => false)),
      'eventos_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Evento', 'required' => false)),
      'evaluaciones_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Evaluacion', 'required' => false)),
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

    if (isset($this->widgetSchema['eventos_list']))
    {
      $this->setDefault('eventos_list', $this->object->Eventos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['evaluaciones_list']))
    {
      $this->setDefault('evaluaciones_list', $this->object->Evaluaciones->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveRequerimientosList($con);
    $this->saveRequisitosList($con);
    $this->saveDocumentosList($con);
    $this->saveEventosList($con);
    $this->saveEvaluacionesList($con);

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

  public function saveEventosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['eventos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Eventos->getPrimaryKeys();
    $values = $this->getValue('eventos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Eventos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Eventos', array_values($link));
    }
  }

  public function saveEvaluacionesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['evaluaciones_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Evaluaciones->getPrimaryKeys();
    $values = $this->getValue('evaluaciones_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Evaluaciones', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Evaluaciones', array_values($link));
    }
  }

}
