<?php

class Mailer
{
    // definition of parameters
    //     title -> title of email
    //     content -> content of email
    //     to -> set of containers of reception
    public static function send($parameters, $mailer) {
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
                $mailer->send($message);
                return true;
            } catch (Exception $e) {
                // Transport exception, who care!!
                return false;
            }
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
                'convocatorias/email_states',
                array(
                    'convocatoria' => $convocatoria,
                    'user' => $controller->getUser(),
                    'operation' => $state,
                )),
            'to' => $to,
        ),
            $controller->getMailer()
        );
    }

    public static function sendPostulantConfirmation($hash, $form, $controller) {
        $convocatoria = $controller->getRoute()->getObject();
        $tpl_title = 'Confirmación de postulación a la convocatoria %s';

        return Mailer::send(array(
            'title' => sprintf($tpl_title, $convocatoria->getGestion()),
            'content' => $controller->getPartial(
                'convocatorias/email_postulants',
                array(
                    'convocatoria' => $convocatoria,
                    'postulante' => $form->getId(),
                    'hash' => $hash,
                )),
            'to' => array($form->getEmail()),
        ),
            $controller->getMailer()
        );
    }
}
