<?php

class RequerimientoForm extends BaseRequerimientoForm
{
    public function configure() {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['convocatorias_list']
        );

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
