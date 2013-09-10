<?php

class Mailer
{
    private static $instance = null;

    private $mailer = null;
    private $context = null;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setMailer($mailer) {
        $this->mailer = $mailer;

        return self::$instance;
    }

    public function getMailer() {
        if (empty($this->mailer)) {
            $this->mailer = sfContext::getInstance()->getMailer();
        }

        return $this->mailer;
    }

    public function initPartials() {
        sfContext::getInstance()
            ->getConfiguration()
            ->loadHelpers(array('Partial'));
    }

    // definition of parameters
    //     title -> title of email
    //     content -> content of email
    //     to -> set of containers of reception
    public function send($parameters) {
        if (!isset($parameters['title'])) {
            $parameters['title'] = '';
        }
        if (!isset($parameters['content'])) {
            $parameters['content'] = '';
        }
        if (!isset($parameters['to'])) {
            $parameters['to'] = array();
        }

        if (!empty($parameters['to'])) {
            $message = Swift_Message::newInstance()
                ->setFrom(
                    sfConfig::get('app_sf_guard_plugin_default_from_email'))
                ->setTo($parameters['to'])
                ->setSubject($parameters['title'])
                ->setBody($parameters['content'])
                ->setContentType('text/html');

            try {
                $this->getMailer()->send($message);
                return true;
            } catch (Exception $e) {
//                echo $e->getTraceAsString();
                // Transport exception, who care!!
                return false;
            }
        }
    }

    public function _getNotifiers($convocatoria) {
        // extract of subscribers
        $subscribers = $convocatoria->getNotificaciones();
        $to = array();
        foreach ($subscribers as $subscriber) {
            $to[$subscriber->getEmail()] = $subscriber->getEncargado();
        }

        return $to;
    }

    public function sendChangeStateConvocatoria($state, $convocatoria) {
        $this->initPartials();

        $tpl_title = 'Sistema de Convocatorias [convocatoria %s fue %s]';
        return $this->send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion(), $state),
            'content' => get_partial(
                'convocatorias/email/changeState',
                array(
                    'convocatoria' => $convocatoria,
                    'operation' => $state,
                )),
            'to' => $this->_getNotifiers($convocatoria),
        ));
    }

    public function sendPostulantConfirmation($hash, $form, $convocatoria) {
        $this->initPartials();

        $tpl_title = 'Confirmación de postulación a la convocatoria %s';
        return $this->send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion()),
            'content' => get_partial(
                'convocatorias/email/postulation',
                array(
                    'convocatoria' => $convocatoria,
                    'postulante' => $form->getId(),
                    'hash' => $hash,
                )),
            'to' => array($form->getEmail()),
        ));
    }

    public function sendEndPostulation($convocatoria) {
        $this->initPartials();

        $tpl_title = 'Cierre de postulaciones para convocatoria %s';
        return $this->send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion()),
            'content' => get_partial(
                'convocatorias/email/endPostulants',
                array(
                    'convocatoria' => $convocatoria,
                )),
            'to' => $this->_getNotifiers($convocatoria),
        ));
    }

    public function sendEndDocuments($convocatoria) {
        $this->initPartials();

        $tpl_title = 'Cierre de registro de documentos de postulación';
        return $this->send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion()),
            'content' => get_partial(
                'convocatorias/email/endDocuments',
                array(
                    'convocatoria' => $convocatoria,
                )),
            'to' => $this->_getNotifiers($convocatoria),
        ));
    }

    public function sendEndHabilitations($convocatoria) {
        $this->initPartials();

        $tpl_title = 'Publicación de la tabla de habilitados';
        return $this->send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion()),
            'content' => get_partial(
                'convocatorias/email/endHabilitations',
                array(
                    'convocatoria' => $convocatoria,
                )),
            'to' => $this->_getNotifiers($convocatoria),
        ));
    }
}
