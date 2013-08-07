<?php

class DocumentoForm extends BaseDocumentoForm
{
    public function configure() {
        $this->useFields(array(
            'texto',
        ));

        $this->widgetSchema->setLabels(array(
            'texto' => 'Descripción (*):',
        ));

        $this->widgetSchema['texto']->setAttribute('class', 'focus');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');
    }
}
