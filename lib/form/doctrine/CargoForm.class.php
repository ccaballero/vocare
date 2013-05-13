<?php

class CargoForm extends BaseCargoForm
{
    public function configure() {
        $this->widgetSchema->setLabels(array(
            'cargo' => 'Cargo (*):',
        ));

        $this->widgetSchema['cargo']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');

//        if ($this->getObject()->isNew()) {
//            $encargado = new CargoEncargadoForm();
////            $encargado->setResources($this->getObject());
////$newDescription->setId($this->getObject()->getId());
////$newDescriptionForm = new ResourceDescriptionsForm($newDescription);
//            $this->embedForm('Encargado', $encargado);
//        }
//        $this->embedRelation('Encargados', new CargoEncargadoForm($this->getObject()->getEncargados()));
    }
}
