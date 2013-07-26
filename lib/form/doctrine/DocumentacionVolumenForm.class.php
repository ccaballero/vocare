<?php

class DocumentacionVolumenForm extends BaseDocumentacionVolumenForm
{
    public function configure() {
        unset(
            $this['vars'],
            $this['created_at'],
            $this['updated_at']
        );

        $this->widgetSchema->setLabels(array(
            'template_id' => 'Plantilla (*):',
            'label' => 'Nombre (*):',
        ));

        $this->widgetSchema['label']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
    
    public function doSave($con = null) {
//        parent::doSave($con);
        
        if ($this->isNew()) {
            $template_id = $this->getValue('template_id');
            $label = $this->getValue('label');

            $volumen = new DocumentacionVolumen();
            $volumen->template_id = $template_id;
            $volumen->label = $label;
                    
            $volumen->save();
        }
    }
}
