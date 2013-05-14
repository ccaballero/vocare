<?php

class CargoForm extends BaseCargoForm
{
    public function configure() {
        $this->widgetSchema->setLabels(array(
            'cargo' => 'Cargo (*):',
        ));

        $this->widgetSchema['cargo']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
