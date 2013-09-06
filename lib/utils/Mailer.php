<?php

class Mailer
{
    private static $instance = null;

    private $mailer = null;

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
                // Transport exception, who care!!
                return false;
            }
        }
    }

    public function sendChangeStateConvocatoria($state, $convocatoria) {
        $tpl_title = 'Sistema de Convocatorias [convocatoria %s fue %s]';

        // extract of subscribers
        $subscribers = $convocatoria->getNotificaciones();
        $to = array();
        foreach ($subscribers as $subscriber) {
            $to[$subscriber->getEmail()] = $subscriber->getEncargado();
        }

        sfContext::getInstance()
            ->getConfiguration()
            ->loadHelpers(array('Partial'));

        return $this->send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion(), $state),
            'content' => get_partial(
                'convocatorias/email_states',
                array(
                    'convocatoria' => $convocatoria,
                    'operation' => $state,
                )),
            'to' => $to,
        ));
    }

    public function sendPostulantConfirmation($hash, $form, $convocatoria) {
        $tpl_title = 'Confirmación de postulación a la convocatoria %s';

        sfContext::getInstance()
            ->getConfiguration()
            ->loadHelpers(array('Partial'));

        return $this->send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion()),
            'content' => get_partial(
                'convocatorias/email_postulants',
                array(
                    'convocatoria' => $convocatoria,
                    'postulante' => $form->getId(),
                    'hash' => $hash,
                )),
            'to' => array($form->getEmail()),
        ));
    }
}
