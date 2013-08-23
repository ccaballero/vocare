<?php

class PostulanteReceptionForm extends BasePostulanteForm
{
    public function configure() {
        $this->useFields(array(
            'numero_hojas',
        ));

        $this->widgetSchema->setLabels(array(
            'numero_hojas' => 'Número de Hojas (*):',
        ));

        $this->widgetSchema['numero_hojas']->setAttribute('class', 'focus');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');

        $this->validatorSchema['numero_hojas'] = new sfValidatorInteger();
    }

    public function setConvocatoria($convocatoria) {
        $this->object->Convocatoria = $convocatoria;
    }
}
