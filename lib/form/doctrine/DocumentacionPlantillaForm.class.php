<?php

class DocumentacionPlantillaForm extends BaseDocumentacionPlantillaForm
{
    public function configure() {
        unset(
            $this['types'],
            $this['created_at'],
            $this['updated_at']
        );

        $this->widgetSchema->setLabels(array(
            'label' => 'Título (*):',
            'redaction' => 'Redacción:',
        ));

        $this->widgetSchema['label']->setAttribute('class', 'focus');
        $this->widgetSchema['redaction']->setAttribute('class', 'middle-area');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
