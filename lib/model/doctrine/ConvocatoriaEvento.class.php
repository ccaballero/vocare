<?php

class ConvocatoriaEvento extends BaseConvocatoriaEvento
{
    public function getPrettyFecha() {
        include_once realpath(dirname(__FILE__)
            . '/../../../apps/convocatorias/lib/helper/PrettyDateHelper.php');
        return pretty_date($this->_get('fecha'));
    }

    public function __toString() {
        return $this->getFecha() . ' -> ' . $this->getEvento()->getNombre();
    }

    // Cambio del estado de la convocatoria -> vigente
    public function triggerInitialize() {
        $convocatoria = $this->getConvocatoria();
        $convocatoria->executeTransform('promover');

        // notification
        Mailer::getInstance()
            ->sendChangeStateConvocatoria('publicada', $convocatoria);
    }

    // Cambio del estado de la convocatoria -> finalizada
    public function triggerFinalize() {
        $convocatoria = $this->getConvocatoria();
        $convocatoria->executeTransform('finalizar');

        // notification
        Mailer::getInstance()
            ->sendChangeStateConvocatoria('finalizada', $convocatoria);
    }

    public function triggerEndPostulations() {
        
    }

    public function triggerEndDocuments() {
        
    }
    
    public function triggerPubHabilitations() {
        
    }

    public function triggerPubTests() {
        // TODO
    }

    public function triggerPubResults() {
        // TODO
    }
}
