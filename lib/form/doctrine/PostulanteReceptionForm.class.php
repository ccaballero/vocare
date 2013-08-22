<?php

class PostulanteReceptionForm extends BasePostulanteForm
{
    public function configure() {
        $this->useFields(array(
            'numero_hojas',
            'documentos_list',
        ));

        $this->widgetSchema->setLabels(array(
            'numero_hojas' => 'Número de Hojas (*):',
            'documentos_list' => 'Documentos:',
        ));

        $this->widgetSchema['numero_hojas']->setAttribute('class', 'focus');

        $this->widgetSchema['documentos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');

        $this->widgetSchema['documentos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererDocumentos')
        ));

        $this->validatorSchema['numero_hojas'] = new sfValidatorInteger();
        $this->validatorSchema['documentos_list'] =
            new sfValidatorDoctrineChoice(
                array(
                    'multiple' => true,
                    'model' => 'Documento',
                    'required' => true,
                    'min' => 1));
    }

    public function rendererDocumentos($widget, $inputs) {
        $result = '<table class="form-table">';
        foreach ($inputs as $key => $input) {
            $item = preg_replace(
                '/.* value="(\d+)" .*/', '$1', $input['input']);

            $value = array(' ', ' ');
            if (!empty($this->documentos) &&
                array_key_exists($item, $this->documentos[0])) {
                $value = array(
                    'value="' . $this->documentos[0][$item] . '" ',
                    'value="' . $this->documentos[1][$item] . '" ',
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
