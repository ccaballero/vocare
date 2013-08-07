<?php

class EventoForm extends BaseEventoForm
{
    public function configure() {
        $this->useFields(array(
            'descripcion',
        ));

        $this->widgetSchema->setLabels(array(
            'descripcion' => 'Descripción (*):',
        ));

        $this->widgetSchema['descripcion']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
