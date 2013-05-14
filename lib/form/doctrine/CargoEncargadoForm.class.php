<?php

class CargoEncargadoForm extends BaseCargoEncargadoForm
{
    public function configure() {
        unset(
            $this['cargo_id'],
            $this['fecha']
        );

        $this->widgetSchema->setLabels(array(
            'encargado' => 'Encargado (*):',
        ));
        
        $this->widgetSchema['encargado']->setAttribute('class', 'focus');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
