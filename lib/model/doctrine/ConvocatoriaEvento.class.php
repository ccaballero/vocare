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
        return Mailer::getInstance()
            ->sendChangeStateConvocatoria('publicada', $convocatoria);
    }

    // Cambio del estado de la convocatoria -> finalizada
    public function triggerFinalize() {
        $convocatoria = $this->getConvocatoria();
        $convocatoria->executeTransform('finalizar');

        // notification
        return Mailer::getInstance()
            ->sendChangeStateConvocatoria('finalizada', $convocatoria);
    }

    public function triggerEndPostulations() {
        $convocatoria = $this->getConvocatoria();

        return Mailer::getInstance()
            ->sendEndPostulation($convocatoria);
    }

    public function triggerEndDocuments() {
        $convocatoria = $this->getConvocatoria();

        return Mailer::getInstance()
            ->sendEndDocuments($convocatoria);
    }

    public function triggerPubHabilitations() {
        $convocatoria = $this->getConvocatoria();

        return Mailer::getInstance()
            ->sendPubHabilitations($convocatoria);
    }

    public function triggerPubTests() {
        // TODO
        return true;
    }

    public function triggerPubResults() {
        // TODO
        return true;
    }
}
