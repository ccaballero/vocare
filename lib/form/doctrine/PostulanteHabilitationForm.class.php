<?php

class PostulanteReceptionForm extends BasePostulanteForm
{
    public function configure() {
        $this->useFields(array(
            'numero_hojas',
            'requisitos_list',
        ));

        $this->widgetSchema->setLabels(array(
            'numero_hojas' => 'Número de Hojas (*):',
            'requisitos_list' => 'Requisitos:',
        ));

        $this->widgetSchema['numero_hojas']->setAttribute('class', 'focus');

        $this->widgetSchema['requisitos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');

        $this->widgetSchema['requisitos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererRequisitos')
        ));

        $this->validatorSchema['numero_hojas'] = new sfValidatorInteger();
        $this->validatorSchema['requisitos_list'] =
            new sfValidatorDoctrineChoice(
                array(
                    'multiple' => true,
                    'model' => 'Requisito',
                    'required' => true,
                    'min' => 1));
    }

    public function rendererRequisitos($widget, $inputs) {
        $result = '<table class="form-table">';
        foreach ($inputs as $key => $input) {
            $item = preg_replace(
                '/.* value="(\d+)" .*/', '$1', $input['input']);

            $value = array(' ', ' ');
            if (!empty($this->requisitos) &&
                array_key_exists($item, $this->requisitos[0])) {
                $value = array(
                    'value="' . $this->requisitos[0][$item] . '" ',
                    'value="' . $this->requisitos[1][$item] . '" ',
                );
            }

            $result .= '<tr><td>' . $input['input']
                    . '</td><td>' . $input['label'] . '</td></tr>';
        }
        $result .= '</table>';
        return $result;
    }

    public function setConvocatoria($convocatoria) {
        $this->object->Convocatoria = $convocatoria;
    }
}