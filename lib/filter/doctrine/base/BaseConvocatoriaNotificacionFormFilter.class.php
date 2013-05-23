<?php

/**
 * ConvocatoriaNotificacion filter form base class.
 *
 * @package    .
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConvocatoriaNotificacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'convocatoria_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Convocatoria'), 'add_empty' => true)),
      'cargo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'encargado'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'convocatoria_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Convocatoria'), 'column' => 'id')),
      'cargo'           => new sfValidatorPass(array('required' => false)),
      'encargado'       => new sfValidatorPass(array('required' => false)),
      'email'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('convocatoria_notificacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConvocatoriaNotificacion';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'convocatoria_id' => 'ForeignKey',
      'cargo'           => 'Text',
      'encargado'       => 'Text',
      'email'           => 'Text',
    );
  }
}
