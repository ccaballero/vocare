<?php

class PostulanteHabilitationForm extends BasePostulanteForm
{
    public function configure() {
        $this->useFields(array(
            'requisitos_list',
            'documentos_list',
        ));

        $this->widgetSchema->setLabels(array(
            'requisitos_list' => 'Requisitos:',
            'documentos_list' => 'Documentos:',
        ));

        $this->widgetSchema['requisitos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');
        $this->widgetSchema['documentos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');

        $this->widgetSchema['requisitos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererRequisitos')
        ));
        $this->widgetSchema['documentos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererDocumentos')
        ));

        $this->validatorSchema['requisitos_list'] =
            new sfValidatorDoctrineChoice(
                array(
                    'multiple' => true,
                    'model' => 'Requisito',
                    'required' => false,
                    'min' => 0));
        $this->validatorSchema['documentos_list'] =
            new sfValidatorDoctrineChoice(
                array(
                    'multiple' => true,
                    'model' => 'Documento',
                    'required' => false,
                    'min' => 0));
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

        $query1 = Doctrine_Query::create()
               ->from('Requisito r')
               ->leftJoin('r.ConvocatoriaRequisitos cr')
               ->where('cr.convocatoria_id = ?', $convocatoria->getId())
               ->orderBy('cr.numero_orden ASC');
        $this->widgetSchema['requisitos_list']->setOption('query', $query1);

        $query2 = Doctrine_Query::create()
                ->from('Documento r')
                ->leftJoin('r.ConvocatoriaDocumentos cr')
                ->where('cr.convocatoria_id = ?', $convocatoria->getId())
               ->orderBy('cr.numero_orden ASC');
        $this->widgetSchema['documentos_list']->setOption('query', $query2);
    }
}
