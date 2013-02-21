<?php

class ConvocatoriaForm extends BaseConvocatoriaForm
{
    public function configure() {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['estado']
        );

        $this->widgetSchema->setLabels(array(
            'nombre' => 'Nombre:',
            'requerimientos_list' => 'Requerimientos:',
            'requisitos_list' => 'Requisitos:',
            'documentos_list' => 'Documentos:',
            'eventos_list' => 'Eventos:',
        ));

//        sfWidgetFormSelectDoubleList
        $this->widgetSchema['requerimientos_list']->setOption('renderer_class', 'sfWidgetFormSelectCheckbox');
        $this->widgetSchema['requisitos_list']->setOption('renderer_class', 'sfWidgetFormSelectCheckbox');
        $this->widgetSchema['documentos_list']->setOption('renderer_class', 'sfWidgetFormSelectCheckbox');
        $this->widgetSchema['eventos_list']->setOption('renderer_class', 'sfWidgetFormSelectCheckbox');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');

        $this->widgetSchema['requerimientos_list']->setOption('renderer_options', array('formatter' => array($this, 'rendererChecks')));
        $this->widgetSchema['requisitos_list']->setOption('renderer_options', array('formatter' => array($this, 'rendererChecks')));
        $this->widgetSchema['documentos_list']->setOption('renderer_options', array('formatter' => array($this, 'rendererChecks')));
        $this->widgetSchema['eventos_list']->setOption('renderer_options', array('formatter' => array($this, 'rendererChecks')));
    }

    public static function rendererChecks($widget, $inputs) {
        $result = '<table class="form-table">';
        foreach ($inputs as $input) {
            $result .= '<tr><td style="width:16px">' . $input ['input'] . '</td><td>' . $input ['label'] . '</td></tr>';
        }
        $result .= '</table>';
        return $result;
    }
}
