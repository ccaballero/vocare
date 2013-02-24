<?php

class RequisitoForm extends BaseRequisitoForm
{
    public function configure() {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['convocatorias_list']
        );
        
        unset($this['created_at'], $this['updated_at']);

        $this->widgetSchema->setLabels(array(
            'texto' => 'Descripción:',
        ));

        $this->widgetSchema['texto']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
 