<?php

class ConvocatoriaForm extends BaseConvocatoriaForm
{
    public function configure() {
        $this->useFields(array(
            'gestion',
            'requerimientos_list',
            'requisitos_list',
            'documentos_list',
            'eventos_list',
        ));

        $this->widgetSchema->setLabels(array(
            'gestion' => 'Gestión (*):',
            'requerimientos_list' => 'Requerimientos:',
            'requisitos_list' => 'Requisitos:',
            'documentos_list' => 'Documentos:',
            'eventos_list' => 'Eventos:',
        ));

        $this->widgetSchema['gestion']->setAttribute('class', 'focus');

        $this->widgetSchema['requerimientos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');
        $this->widgetSchema['requisitos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');
        $this->widgetSchema['documentos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');
        $this->widgetSchema['eventos_list']->setOption(
            'renderer_class', 'sfWidgetFormSelectCheckbox');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');

        $this->widgetSchema['requerimientos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererRequerimientos')
            ));
        $this->widgetSchema['requisitos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererRequisitos')
            ));
        $this->widgetSchema['documentos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererDocumentos')
            ));
        $this->widgetSchema['eventos_list']->setOption(
            'renderer_options', array(
                'formatter' => array($this, 'rendererEventos')
            ));
    }

    public function removeFocus() {
        $this->widgetSchema['gestion']->setAttributes(array());
    }

    public static function rendererBase($widget, $inputs) {
        $result = '<table class="form-table">';
        foreach ($inputs as $input) {
            $result .= '<tr><td style="width:16px">' . $input['input']
                    . '</td><td>' . $input['label'] . '</td></tr>';
        }
        $result .= '</table>';
        return $result;
    }

    public function rendererRequerimientos($widget, $inputs) {
        $result = '<table class="form-table"><tr>'
                . '<th>&nbsp;</th>'
                . '<th>Item</th>'
                . '<th>Cantidad</th>'
                . '<th>&nbsp;</th>'
                . '</tr>';
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

            $append = array(
                '<input type="text" name="requerimientos[0][' . $item
                . ']" class="text-right" style="width:36px"' . $value[0] . '/>',
                '<input type="text" name="requerimientos[1][' . $item
                . ']" class="text-right" style="width:36px"' . $value[1] . '/>'
            );

            $result .= '<tr><td style="width:16px">' . $input['input']
                    . '</td><td style="width:36px">' . $append[0]
                    . '</td><td style="width:36px">' . $append[1]
                    . '</td><td>' . $input['label'] . '</td></tr>';
        }
        $result .= '</table>';
        return $result;
    }

    public function rendererRequisitos($widget, $inputs) {
        $result = '<table class="form-table"><tr>'
                . '<th>&nbsp;</th>'
                . '<th>Orden</th>'
                . '<th>&nbsp;</th>'
                . '</tr>';
        foreach ($inputs as $input) {
            $item = preg_replace(
                '/.* value="(\d+)" .*/', '$1', $input['input']);

            $value = ' ';
            if (array_key_exists($item, $this->requisitos)) {
                $value = 'value="' . $this->requisitos[$item] . '" ';
            }

            $append = '<input type="text" name="requisitos[' . $item
                . ']" class="text-right" style="width:36px"' . $value . '/>';

            $result .= '<tr><td style="width:16px">' . $input['input']
                    . '</td><td style="width:36px">' . $append
                    . '</td><td>' . $input['label'] . '</td></tr>';
        }
        $result .= '</table>';
        return $result;
    }

    public function rendererDocumentos($widget, $inputs) {
        $result = '<table class="form-table"><tr>'
                . '<th>&nbsp;</th>'
                . '<th>Orden</th>'
                . '<th>&nbsp;</th>'
                . '</tr>';
        foreach ($inputs as $input) {
            $item = preg_replace(
                '/.* value="(\d+)" .*/', '$1', $input['input']);

            $value = ' ';
            if (array_key_exists($item, $this->documentos)) {
                $value = 'value="' . $this->documentos[$item] . '" ';
            }

            $append = '<input type="text" name="documentos[' . $item
                . ']" class="text-right" style="width:36px"' . $value . '/>';

            $result .= '<tr><td style="width:16px">' . $input['input']
                    . '</td><td style="width:36px">' . $append
                    . '</td><td>' . $input['label'] . '</td></tr>';
        }
        $result .= '</table>';
        return $result;
    }

    public function rendererEventos($widget, $inputs) {
        $result = '<table class="form-table"><tr>'
                . '<th>&nbsp;</th>'
                . '<th>Fecha</th>'
                . '<th>&nbsp;</th>'
                . '</tr>';
        foreach ($inputs as $input) {
            $item = preg_replace(
                '/.* value="(\d+)" .*/', '$1', $input['input']);

            $value = ' ';
            if (array_key_exists($item, $this->eventos)) {
                $value = 'value="' . $this->eventos[$item] . '" ';
            }

            $append = '<input type="text" name="eventos[' . $item
                . ']" class="text-center datepicker" style="width:100px"'
                . $value . '/>';

            $result .= '<tr><td style="width:16px">' . $input['input']
                    . '</td><td style="width:80px">' . $append
                    . '</td><td>' . $input['label'] . '</td></tr>';
        }
        $result .= '</table>';
        return $result;
    }

    public $requerimientos = array(array(), array());
    public function setRequerimientos($requerimientos) {
        $this->requerimientos = $requerimientos;
    }

    public function fetchRequerimientos($convocatoria) {
        $q = Doctrine_Query::create()
            ->from('ConvocatoriaRequerimiento cr')
            ->where('cr.convocatoria_id = ?', $convocatoria->id);

        $requerimientos = array();
        foreach ($q->fetchArray() as $_requerimiento) {
            $requerimientos[0][$_requerimiento['requerimiento_id']] =
                $_requerimiento['numero_item'];
            $requerimientos[1][$_requerimiento['requerimiento_id']] =
                $_requerimiento['cantidad_requerida'];
        }
        $this->setRequerimientos($requerimientos);
    }

    public $requisitos = array();
    public function setRequisitos($requisitos) {
        $this->requisitos = $requisitos;
    }

    public function fetchRequisitos($convocatoria) {
        $q = Doctrine_Query::create()
            ->from('ConvocatoriaRequisito cr')
            ->where('cr.convocatoria_id = ?', $convocatoria->id);
        $requisitos = array();
        foreach ($q->fetchArray() as $_requisito) {
            $requisitos[$_requisito['requisito_id']] =
                $_requisito['numero_orden'];
        }
        $this->setRequisitos($requisitos);
    }

    public $documentos = array();
    public function setDocumentos($documentos) {
        $this->documentos = $documentos;
    }

    public function fetchDocumentos($convocatoria) {
        $q = Doctrine_Query::create()
            ->from('ConvocatoriaDocumento cd')
            ->where('cd.convocatoria_id = ?', $convocatoria->id);
        $documentos = array();
        foreach ($q->fetchArray() as $_documento) {
            $documentos[$_documento['documento_id']] =
                $_documento['numero_orden'];
        }
        $this->setDocumentos($documentos);
    }

    public $eventos = array();
    public function setEventos($eventos) {
        $this->eventos = $eventos;
    }

    public function fetchEventos($convocatoria) {
        $q = Doctrine_Query::create()
            ->from('ConvocatoriaEvento ce')
            ->where('ce.convocatoria_id = ?', $convocatoria->id);
        $eventos = array();
        foreach ($q->fetchArray() as $_evento) {
            $eventos[$_evento['evento_id']] = $_evento['fecha'];
        }
        $this->setEventos($eventos);
    }

    public function doSave($con = null) {
        parent::doSave($con);

        $id_convocatoria = $this->object->getId();

        foreach ($this->object->Requerimientos as $requerimiento) {
            if (array_key_exists($requerimiento->id, $this->requerimientos[0])
                && !empty($this->requerimientos[0][$requerimiento->id])) {

                $id_requerimiento = $requerimiento->id;
                $item = intval($this->requerimientos[0][$requerimiento->id]);
                $cant = intval($this->requerimientos[1][$requerimiento->id]);

                $q = Doctrine_Query::create()
                    ->update('ConvocatoriaRequerimiento r')
                    ->set('r.numero_item', '?', $item)
                    ->set('r.cantidad_requerida', '?', $cant)
                    ->where('r.convocatoria_id = ?', $id_convocatoria)
                    ->andwhere('r.requerimiento_id = ?', $id_requerimiento);
                $q->execute();
            }
        }

        foreach ($this->object->Requisitos as $requisito) {
            if (array_key_exists($requisito->id, $this->requisitos) &&
                !empty($this->requisitos[$requisito->id])) {

                $id_requisito = $requisito->id;
                $value = $this->requisitos[$requisito->id];
                $q = Doctrine_Query::create()
                    ->update('ConvocatoriaRequisito r')
                    ->set('r.numero_orden', '?', $value)
                    ->where('r.convocatoria_id = ?', $id_convocatoria)
                    ->andwhere('r.requisito_id = ?', $id_requisito);
                $q->execute();
            }
        }

        foreach ($this->object->Documentos as $documento) {
            if (array_key_exists($documento->id, $this->documentos) &&
                !empty($this->documentos[$documento->id])) {

                $id_documento = $documento->id;
                $value = $this->documentos[$documento->id];
                $q = Doctrine_Query::create()
                    ->update('ConvocatoriaDocumento d')
                    ->set('d.numero_orden', '?', $value)
                    ->where('d.convocatoria_id = ?', $id_convocatoria)
                    ->andwhere('d.documento_id = ?', $id_documento);
                $q->execute();
            }
        }

        foreach ($this->object->Eventos as $evento) {
            if (array_key_exists($evento->id, $this->eventos) &&
                !empty($this->eventos[$evento->id])) {

                $id_evento = $evento->id;
                $value = $this->eventos[$evento->id];
                $q = Doctrine_Query::create()
                    ->update('ConvocatoriaEvento e')
                    ->set('e.fecha', '?', $value)
                    ->where('e.convocatoria_id = ?', $id_convocatoria)
                    ->andwhere('e.evento_id = ?', $id_evento);
                $q->execute();
            }
        }
    }
}
