<?php

/**
 * ConvocatoriaRequerimientoEvaluacion filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaRequerimientoEvaluacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('convocatoria_requerimiento_evaluacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaRequerimientoEvaluacion';
  }

  public function getFields()
  {
    return array(
      'convocatoria_id'  => 'Number',
      'requerimiento_id' => 'Number',
      'evaluacion_id'    => 'Number',
    );
  }
}
