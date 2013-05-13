<?php

class CargoEncargadoForm extends BaseCargoEncargadoForm
{
    public function configure() {
        unset(
            $this['fecha']
        );
        
        $this->setWidgets(array(
            'cargo_id' => new sfWidgetFormInputHidden(array('default' => $this->getObject()->getId())),
            'encargado' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
        ));
        
        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
