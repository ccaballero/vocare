<?php

class DocumentoForm extends BaseDocumentoForm
{
    public function configure() {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['convocatorias_list']
        );
        
        $this->widgetSchema->setLabels(array(
            'texto' => 'Descripción (*):',
        ));

        $this->widgetSchema['texto']->setAttribute('class', 'focus');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');
    }
}
