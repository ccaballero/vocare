<?php

class CartaForm extends BaseCartaForm
{
    public function configure() {
        unset(
            $this['created_at'],
            $this['updated_at']
        );

        $this->widgetSchema->setLabels(array(
            'nombre' => 'Título (*):',
            'redaccion' => 'Redacción:',
        ));

        $this->widgetSchema['nombre']->setAttribute('class', 'focus');
        $this->widgetSchema['redaccion']->setAttribute('class', 'middle-area');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
