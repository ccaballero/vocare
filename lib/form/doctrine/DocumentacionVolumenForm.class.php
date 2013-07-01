<?php

class DocumentacionVolumenForm extends BaseDocumentacionVolumenForm
{
    public function configure() {
        unset(
            $this['vars'],
            $this['created_at'],
            $this['updated_at']
        );

        $this->widgetSchema->setLabels(array(
            'plantilla_id' => 'Plantilla (*):',
            'nombre' => 'Nombre (*):',
        ));

        $this->widgetSchema['nombre']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
