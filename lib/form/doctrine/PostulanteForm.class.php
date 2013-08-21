<?php

class PostulanteForm extends BasePostulanteForm
{
    public function configure() {
        $this->useFields(array(
            'apellido_paterno',
            'apellido_materno',
            'nombres',
            'ci',
            'sis',
            'correo_electronico',
            'telefono',
            'direccion',
            'requerimientos_list',
        ));

        $this->widgetSchema->setLabels(array(
            'apellido_paterno' => 'Apellido Paterno (*):',
            'apellido_materno' => 'Apellido Materno:',
            'nombres' => 'Nombres (*):',
            'ci' => 'Nro. de carnet de Identidad (*):',
            'sis' => 'Codigo SIS (*):',
            'correo_electronico' => 'Correo Electrónico (*):',
            'telefono' => 'Teléfono:',
            'direccion' => 'Dirección:',
            'requerimientos_list' => 'Ítems a los que se postula:',
        ));

        $this->widgetSchema['apellido_paterno']->setAttribute('class', 'focus');

        $this->widgetSchema['requerimientos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');

        $this->widgetSchema['requerimientos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererRequerimientos')
        ));

        $this->validatorSchema['sis'] = new sfValidatorInteger();
        $this->validatorSchema['correo_electronico'] = new sfValidatorEmail();
        $this->validatorSchema['requerimientos_list'] =
            new sfValidatorDoctrineChoice(
                array(
                    'multiple' => true,
                    'model' => 'Requerimiento',
                    'required' => true,
                    'min' => 1));
    }

    public function rendererRequerimientos($widget, $inputs) {
        $result = '<table class="form-table">';
        foreach ($inputs as $key => $input) {
            $item = preg_replace(
                '/.* value="(\d+)" .*/', '$1', $input['input']);

            $value = array(' ', ' ');
            if (!empty($this->requerimientos) &&
                array_key_exists($item, $this->requerimientos[0])) {
                $value = array(
                    'value="' . $this->requerimientos[0][$item] . '" ',
                    'value="' . $this->requerimientos[1][$item] . '" ',
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
