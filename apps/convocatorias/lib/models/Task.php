<?php

class VocareTask {
    private static $instance = null;

    public static $list = array(
        'initialize' => 'Publicación de convocatoria',
        'end-postulations' => 'Finalización de postulaciones',
        'end-documents' => 'Finalización de entrega de documentos',
        'end-habilitations' => 'Finalización del proceso de habilitación',
        'pub-habilitations' => 'Publicación de habilitados',
        'pub-tests' => 'Publicación del rol de examenes',
        'pub-results' => 'Publicación de resultados',
        'finalize' => 'Finalización de convocatoria',
    );

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getTasklist() {
        $prepend = array('----------' => '----------');
        return array_merge($prepend, VocareTask::$list);
    }

    public function triggerInitialize($convocatoria) {
        // Cambio del estado de la convocatoria -> vigente
        $convocatoria->executeTransform('promover');

        return Mailer::getInstance()
            ->sendChangeStateConvocatoria('publicada', $convocatoria);
    }

    public function triggerEndPostulations($convocatoria) {
        return Mailer::getInstance()
            ->sendEndPostulation($convocatoria);
    }

    public function triggerEndDocuments($convocatoria) {
        return Mailer::getInstance()
            ->sendEndDocuments($convocatoria);
    }

    public function triggerEndHabilitations($convocatoria) {
        return Mailer::getInstance()
            ->sendEndHabilitations($convocatoria);
    }

    public function triggerPubHabilitations($convocatoria) {
        return Mailer::getInstance()
            ->sendPubHabilitations($convocatoria);
    }

    public function triggerPubTests($convocatoria) {
        // TODO
        return true;
    }

    public function triggerPubResults($convocatoria) {
        // TODO
        return true;
    }

    public function triggerFinalize($convocatoria) {
        // Cambio del estado de la convocatoria -> finalizada
        $convocatoria->executeTransform('finalizar');

        return Mailer::getInstance()
            ->sendChangeStateConvocatoria('finalizada', $convocatoria);
    }
}
