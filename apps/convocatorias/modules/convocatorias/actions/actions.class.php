<?php

class convocatoriasActions extends PlantillasDefault
{
    public $_table = 'convocatoria';
    public $_form = 'ConvocatoriaForm';
    public $_route_list = 'convocatorias';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar convocatoria',
            'edit' => 'Editar convocatoria',
        ),
        'flash' => array(
            'new' => 'Borrador de convocatoria agregado exitosamente',
            'edit' => 'Borrador de convocatoria editado exitosamente',
            'delete' => 'Borrador de convocatoria eliminado exitosamente',
        ),
    );

    public function executeIndex() {
        $convocatoria = new Convocatoria();
        $this->list = $convocatoria->listAll();
    }

    public function executeShow(sfWebRequest $request) {
        $convocatoria = $this->getRoute()->getObject();
        $this->forward404Unless($convocatoria);

        // Settings of editor form
        $this->form = new ConvocatoriaForm($convocatoria);
        $this->form->removeFocus();

        $this->form->fetchRequerimientos($convocatoria);
        $this->form->fetchRequisitos($convocatoria);
        $this->form->fetchDocumentos($convocatoria);
        $this->form->fetchEventos($convocatoria);

        // And this is the part for redactions
        $this->max_enmienda = $convocatoria->getMaxEnmienda();
        $this->redaction = $convocatoria->getEnmienda($this->max_enmienda);

        // And this is the part for listing of convocatorias (I need to say
        //convocatorias in english, but don't
        $this->list = $convocatoria->listRedactions();
        $this->object = $convocatoria;

        // This is the part where I talk to templating
        $tpl = new myTemplate();
        if (!empty($this->redaction)) {
            $tpl->setTemplate($this->redaction);
            $tpl->setObject($this->object);
            $this->preview = $tpl->render();
        } else {
            $this->preview = null;
            $this->max_enmienda = 0;
        }

        // This is the part for renderer control, Can I say this?
        $state = $this->object->getEstado();

        // This is the part when I build the roles for signatures
        $cargos = new Cargo();
        $this->signatures = $cargos->listAll($convocatoria);
        $this->notifications = $convocatoria->getNotificaciones();

        // This is the part when I generate the groups for a convocatoria
        // I hate that i can't translate the word convocatoria
        $this->users = Doctrine_Core::getTable('sfGuardUser')
             ->createQuery('u')
             ->execute();
        $this->groups = Doctrine_Core::getTable('Grupo')
             ->createQuery('g')
             ->execute();

        $roles = array();
        $assignments = new UsuarioGrupoConvocatoria();

        foreach ($this->groups as $grupo) {
            $roles[$grupo->getId()] = $assignments->getUsuarios(
                $convocatoria, $grupo);
        }
        $this->roles = $roles;

        $this->tabs = array(
            'preview' => true,
            'editor' => ($state == 'borrador') || ($state == 'emitido'),
            'redaction' => ($state == 'borrador') || ($state == 'emitido'),
            'viewers' => ($state == 'borrador' || ($state == 'emitido')),
            'users' => ($state == 'emitido'),
            'results' => ($state == 'vigente') || ($state == 'finalizado'),
        );
    }

    protected function processForm(sfWebRequest $request,
            sfForm $form, $flash = '') {
        $form->setRequerimientos($request->getParameter('requerimientos'));
        $form->setRequisitos($request->getParameter('requisitos'));
        $form->setDocumentos($request->getParameter('documentos'));
        $form->setEventos($request->getParameter('eventos'));

        return parent::processForm($request, $form, $flash);
    }

    private function xsltTrasform($xslt) {
        $convocatoria = $this->getRoute()->getObject();
        $numero_enmienda = $convocatoria->getMaxEnmienda();

        $dirbase1 = sfConfig::get('app_dir_generation');
        $filename1 = $convocatoria->getId() . '_' . $numero_enmienda . '.xml';

        $dirbase2 = sfConfig::get('app_xslt_transforms');
        $filename2 = $xslt . '.xslt';

        $xslDoc = new DOMDocument();
        $xslDoc->load("$dirbase2/$filename2");

        $xmlDoc = new DOMDocument();
        $xmlDoc->loadXML(
            str_replace('&nbsp;', '', file_get_contents("$dirbase1/$filename1"))
        );

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);

        try {
            ob_start();
            $proc->transformToURI($xmlDoc, 'php://output');
            $output = ob_get_contents();
            ob_clean();
            
            return $output;
        } catch (Exception $e) {
            $e->printStackTrace();
        }
    }

    public function executeTexto() {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        $this->getResponse()->setContentType('text/plain; charset=utf-8');

        $this->getResponse()->sendHttpHeaders();
        $this->getResponse()->setContent($this->xsltTrasform('transform-text'));

        return sfView::NONE;
    }

    public function executeLatex() {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        $this->getResponse()->setContentType('text/plain; charset=utf-8');

        $this->getResponse()->sendHttpHeaders();
        $this->getResponse()->setContent($this->xsltTrasform('transform-latex'));

        return sfView::NONE;
    }

    public function executePdf() {
        $object = $this->getRoute()->getObject();

        $latex_dir = realpath(APPLICATION_PATH . '/data/tex/convocatorias');
        $pdflatex_path = '/usr/bin/pdflatex';

        $tex_file = $latex_dir . DIRECTORY_SEPARATOR
                  . $object->getId() . '.tex';
        $pdf_file = $latex_dir . DIRECTORY_SEPARATOR
                  . $object->getId() . '.pdf';

        exec(
            $pdflatex_path . ' -output-directory ' .
            $latex_dir . ' ' . $tex_file
        );

        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        $this->forward404Unless(file_exists($pdf_file));

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        $this->getResponse()->setHttpHeader('Content-Disposition',
            'attachment; filename="convocatoria.pdf' . '"');
        $this->getResponse()->setContentType('application/pdf');

        $this->getResponse()->sendHttpHeaders();
        $this->getResponse()->setContent(readfile($pdf_file));

        return sfView::NONE;
    }

    // questions related by redaction of text in convocatorias
    public function executeRedaccion(sfWebRequest $request) {
        $convocatoria = $this->getRoute()->getObject();
        $estado = $convocatoria->getEstado();
        $redacciones = $convocatoria->getRedacciones();

        $texto_redaccion = $request->getParameter('redaction');
        $numero_enmienda = 1;

        if ($estado == 'emitido' || count($redacciones) == 0) {
            if ($estado == 'emitido') {
                $numero_enmienda = intval($convocatoria->getMaxEnmienda()) + 1;
            }

            $cr = new ConvocatoriaRedaccion();
            $cr->Convocatoria = $convocatoria;
            $cr->redaccion = $texto_redaccion;
            $cr->numero_enmienda = $numero_enmienda;
            $cr->save();

            // notification of change in enmienda;
            $this->emailNotification(
              $this->emailTitle('enmendada'),
                $this->emailContent('enmendada')
            );
        }

        if ($estado == 'borrador') {
            foreach ($redacciones as $redaccion) {
                $redaccion->redaccion = $texto_redaccion;
                $redaccion->save();
            }
        }

        // This is the part where I talk to templating
        $tpl = new myTemplate();
        $tpl->setTemplate($texto_redaccion);
        $tpl->setObject($convocatoria);

        $dirbase = sfConfig::get('app_dir_generation');
        $filename = $convocatoria->getId() . '_' . $numero_enmienda . '.xml';

        $destination = $dirbase . '/' . $filename;
        $content = '<vocare>' . $tpl->render() . '</vocare>';
        $result = file_put_contents($destination, $content);

        $this->getUser()->setFlash('notice', 'La redacción de la convocatoria'
            . ' acaba de ser editada');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $convocatoria->getId())));
    }

    public function executeFirmas(sfWebRequest $request) {
        $convocatoria = $this->getRoute()->getObject();
        $cargos = $request->getParameter('cargos');

        // sort by numero_orden
        asort($cargos);
        $counter = 1;

        // delete the old registers
        Doctrine_Query::create()
            ->delete('ConvocatoriaCargo cc')
            ->where('cc.convocatoria_id = ?', $convocatoria->getId())
            ->execute();

        foreach ($cargos as $id => $peso) {
            $convocatoria_cargo = new ConvocatoriaCargo();
            $convocatoria_cargo->convocatoria_id = $convocatoria->getId();
            $convocatoria_cargo->cargo_id = $id;
            $convocatoria_cargo->numero_orden = $counter++;
            $convocatoria_cargo->save();
        }

        $this->getUser()->setFlash('notice', 'La configuración de las firmas ha'
            . ' sido registrada');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $convocatoria->getId())));
    }

    public function executeNotificaciones(sfWebRequest $request) {
        $convocatoria = $this->getRoute()->getObject();

        $notifications = $request->getParameter('notifications');

        $cargos = $notifications['cargo'];
        $encargados = $notifications['encargado'];
        $emails = $notifications['email'];

        $convocatoria->removeNotifications();

        for ($i = 0; $i < count($encargados); $i++) {
            if (!empty($cargos[$i]) &&
                    !empty($encargados[$i]) && !empty($emails[$i])) {
                $conv_notification = new ConvocatoriaNotificacion();
                $conv_notification->convocatoria_id = $convocatoria->getId();
                $conv_notification->cargo = $cargos[$i];
                $conv_notification->encargado = $encargados[$i];
                $conv_notification->email= $emails[$i];
                $conv_notification->save();
            }
        }

        $this->getUser()->setFlash('notice', 'La configuración de las' .
            ' notificaciones ha sido registrada.');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $convocatoria->getId())) . '#viewers');
    }

    public function executeCargos(sfWebRequest $request) {
        $convocatoria = $this->getRoute()->getObject();
        $roles = $request->getParameter('roles');

        $convocatoria->removeRoles();

        foreach ($roles as $id_group => $users) {
            $users = array_unique($users);
            foreach ($users as $id_user) {
                $usuario = new UsuarioGrupoConvocatoria();
                $usuario->user_id = $id_user;
                $usuario->grupo_id = $id_group;
                $usuario->convocatoria_id = $convocatoria->getId();
                $usuario->save();
            }
        }

        $this->getUser()->setFlash('notice', 'La configuración de los' .
            ' cargos ha sido registrada.');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $convocatoria->getId())) . '#users');
    }

    // method for generalization of actions over convocatorias or whatever.
    private function actionChange($action) {
        $object = $this->getRoute()->getObject();
        $message = $object->executeTransform($action);
        $this->getUser()->setFlash('notice', $message);
        $this->redirect($this->_route_list);
    }

    private function emailTitle($operation) {
        $convocatoria = $this->getRoute()->getObject();
        $tpl = 'Sistema de Convocatorias [convocatoria %s fue %s]';
        return sprintf($tpl, $convocatoria->getGestion(), $operation);
    }

    private function emailContent($operation) {
        $convocatoria = $this->getRoute()->getObject();
        return $this->getPartial(
            'convocatorias/email_notification',
            array(
                'convocatoria' => $convocatoria,
                'user' => $this->getUser(),
                'operation' => $operation,
            ));
    }

    private function emailNotification($title, $content) {
        $convocatoria = $this->getRoute()->getObject();

        // notifications of subscribers
        $subscribers = $convocatoria->getNotificaciones();
        $to = array();
        foreach ($subscribers as $subscriber) {
            $to[$subscriber->getEmail()] = $subscriber->getEncargado();
        }

        if (!empty($to)) {
            $message = Swift_Message::newInstance()
                ->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email'))
                ->setTo($to)
                ->setSubject($title)
                ->setBody($content)
                ->setContentType('text/html');

            $this->getMailer()->send($message);
        }
    }

    // state transition (eliminar)
    public function executeEliminar() {
        $this->emailNotification(
            $this->emailTitle('eliminada'),
            $this->emailContent('eliminada')
        );
        $this->actionChange('eliminar');
    }

    // state transition (promover)
    public function executePromover() {
        $convocatoria = $this->getRoute()->getObject();
        if ($convocatoria->getEstado() == 'borrador') {
            $title = 'emitida';
        } else {
            $title = 'publicada';
        }

        $this->emailNotification(
            $this->emailTitle($title),
            $this->emailContent($title)
        );

        $this->actionChange('promover');
    }

    public function executeAnular() {
        $this->emailNotification(
            $this->emailTitle('anulada'),
            $this->emailContent('anulada')
        );
        // Notificar a los postulantes, si es que existen
        // acerca de la anulacion.

        $this->actionChange('anular');
    }

    public function executeFinalizar() {
        $this->emailNotification(
            $this->emailTitle('finalizada'),
            $this->emailContent('finalizada')
        );

        $this->actionChange('finalizar');
    }
}
