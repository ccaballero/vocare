<?php

class Mailer
{
    // definition of parameters
    //     title -> title of email
    //     content -> content of email
    //     to -> set of containers of reception
    public static function send($parameters) {
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
            } catch (Exception $e) {}
            // Transport exception, who care!!
        }
    }

    public static function sendChangeStateConvocatoria($state, $controller) {
        $convocatoria = $controller->getRoute()->getObject();
        $tpl_title = 'Sistema de Convocatorias [convocatoria %s fue %s]';

        // extract of subscribers
        $subscribers = $convocatoria->getNotificaciones();
        $to = array();
        foreach ($subscribers as $subscriber) {
            $to[$subscriber->getEmail()] = $subscriber->getEncargado();
        }

        return Mailer::send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion(), $state),
            'content' => $controller->getPartial(
                'convocatorias/email_notification',
                array(
                    'convocatoria' => $convocatoria,
                    'user' => $controller->getUser(),
                    'operation' => $state,
                )),
            $to,
        ));
    }
}
