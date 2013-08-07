<?php

class RequerimientoForm extends BaseRequerimientoForm
{
    public function configure() {
        $this->useFields(array(
            'codigo',
            'nombre',
            'texto',
            'horas_academicas',
        ));

        $this->widgetSchema->setLabels(array(
            'codigo' => 'Código (*):',
            'nombre' => 'Nombre (*):',
            'texto' => 'Descripción:',
            'horas_academicas' => 'Horas Academicas (hrs/mes) (*):',
        ));

        $this->widgetSchema['codigo']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
