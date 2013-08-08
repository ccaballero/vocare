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
        $model_convocatorias = new Convocatoria();
        $list = $model_convocatorias->listAll();
        $filtered_list = array();

        foreach ($list as $element) {
            if ($this->getUser()->canView($element)) {
                $filtered_list[] = $element;
            }
        }

        $this->list = $filtered_list;
    }

    public function executeShow(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $this->forward404Unless($this->object);

        // This is the part for renderer control, Can I say this?
        $state = $this->object->getEstado();

        // permission control
        if (!$this->getUser()->canView($this->object)
            && !in_array($state, array('vigente', 'finalizado'))) {
            $this->forward404();
        }

        $this->form = $this->_renderShowEditor($this->object);
        $this->redactions = $this->_renderShowRedaction($this->object);
        $this->preview = $this->_renderShowPreview($this->object,
            $this->redactions['redaction']);
        $this->notifications = $this->_renderShowNotifications($this->object);
        $this->users = $this->_renderShowUsers($this->object);
        $this->postulants = $this->_renderShowPostulants($this->object);

        $this->tabs = array(
            'preview' => true,
            'editor' => ($state == 'borrador') || ($state == 'emitido'),
            'redaction' => ($state == 'borrador') || ($state == 'emitido'),
            'viewers' => ($state == 'borrador' || ($state == 'emitido')),
            'users' => ($state == 'emitido'),
            'postulants' => ($state == 'vigente'),
            'results' => ($state == 'vigente') || ($state == 'finalizado'),
        );

        $this->tab_click = 'preview';
    }

    protected function _renderShowEditor($object) {
        // Settings of editor form
        $form = new ConvocatoriaForm($object);
        $form->removeFocus();

        $form->fetchRequerimientos($object);
        $form->fetchRequisitos($object);
        $form->fetchDocumentos($object);
        $form->fetchEventos($object);

        return $form;
    }

    protected function _renderShowRedaction($object) {
        return array(
            // And this is the part for listing of convocatorias (I need to say
            //convocatorias in english, but don't
            'redactions' => $this->object->listRedactions(),
            // And this is the part for redactions
            'redaction' => $object->getEnmienda($object->getMaxEnmienda()),
        );
    }

    protected function _renderShowPreview($object, $redaction = '') {
        if (empty($redaction)) {
            $redaction = $object->getEnmienda($object->getMaxEnmienda());
        }

        // This is the part where I talk to templating
        if (!empty($redaction)) {
            return Xhtml::render($redaction, $object);
        }
    }

    protected function _renderShowNotifications($object) {
        // This is the part when I build the roles for signatures
        return array(
            'signatures' => Doctrine::getTable('Cargo')->listAll($object),
            'notifications' => $object->getNotificaciones(),
        );
    }

    protected function _renderShowUsers($object) {
        // This is the part when I generate the groups for a convocatoria
        // I hate that i can't translate the word convocatoria
        $users = Doctrine_Core::getTable('sfGuardUser')
             ->createQuery('u')
             ->execute();
        $groups = Doctrine_Core::getTable('Grupo')
             ->createQuery('g')
             ->execute();

        $roles = array();
        foreach ($groups as $grupo) {
            $roles[$grupo->getId()] =
                Doctrine::getTable('UsuarioGrupoConvocatoria')->getUsuarios(
                    $object, $grupo);
        }

        return array(
            'users' => $users,
            'groups' => $groups,
            'roles' => $roles,
        );
    }

    protected function _renderShowPostulants($object) {
        return new PostulanteForm();
    }

    protected function processForm(sfWebRequest $request,
            sfForm $form, $flash = '') {
        $form->setRequerimientos($request->getParameter('requerimientos'));
        $form->setRequisitos($request->getParameter('requisitos'));
        $form->setDocumentos($request->getParameter('documentos'));
        $form->setEventos($request->getParameter('eventos'));

        return parent::processForm($request, $form, $flash);
    }

    public function executeTexto() {
        $this->object = $this->getRoute()->getObject();
        return $this->sendContent(
            Xslt::render(
                'transform-txt',
                $this->object->lastEnmiendaXML()
            )
        );
    }

    public function executeLatex() {
        $this->object = $this->getRoute()->getObject();
        return $this->sendContent(
            Xslt::render(
                'transform-latex',
                $this->object->lastEnmiendaXML()
            )
        );
    }

    public function executePdf() {
        $this->object = $this->getRoute()->getObject();
        $filename = '/' . $this->object->getId() . '_'
            . $this->object->getMaxEnmienda();

        Xslt::save(
            'transform-latex',
            $this->object->lastEnmiendaXML(),
            $filename . '.tex'
        );

        $result = PdfLatex::compile($filename);
        if (!empty($result)) {
            return $this->sendContent(
                readfile($result),
                'application/pdf',
                'convocatoria_' . $this->object->getGestion() . '.pdf'
            );
        } else {
            return $this->sendContent('compilación fallida!!');
        }
    }

    // questions related by redaction of text in convocatorias
    public function executeRedaccion(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $estado = $this->object->getEstado();
        $redacciones = $this->object->getRedacciones();

        $texto_redaccion = $request->getParameter('redaction');
        $numero_enmienda = $this->object->getMaxEnmienda();

        if ($estado == 'emitido' || count($redacciones) == 0) {
            if ($estado == 'emitido') {
                $numero_enmienda++;
            }

            $cr = new ConvocatoriaRedaccion();
            $cr->Convocatoria = $this->object;
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

        $result = $this->object->saveXML();
        if ($result) {
            $this->getUser()->setFlash('success', 'La redacción de la '
                . 'convocatoria acaba de ser editada');
        } else {
            $this->getUser()->setFlash('error', 'La redacción de la '
                . 'convocatoria no pudo ser editada');
        }

        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $this->object->getId())));
    }

    public function executeFirmas(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $cargos = $request->getParameter('cargos');

        // sort by numero_orden
        asort($cargos);
        $counter = 1;

        // delete the old registers
        Doctrine_Query::create()
            ->delete('ConvocatoriaCargo cc')
            ->where('cc.convocatoria_id = ?', $this->object->getId())
            ->execute();

        foreach ($cargos as $id => $peso) {
            $convocatoria_cargo = new ConvocatoriaCargo();
            $convocatoria_cargo->convocatoria_id = $this->object->getId();
            $convocatoria_cargo->cargo_id = $id;
            $convocatoria_cargo->numero_orden = $counter++;
            $convocatoria_cargo->save();
        }

        $this->object->saveXML();
        $this->getUser()->setFlash('success',
            'La configuración de las firmas ha sido registrada');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $this->object->getId())));
    }

    public function executeNotificaciones(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();

        $notifications = $request->getParameter('notifications');

        $cargos = $notifications['cargo'];
        $encargados = $notifications['encargado'];
        $emails = $notifications['email'];

        $this->object->removeNotifications();

        for ($i = 0; $i < count($encargados); $i++) {
            if (!empty($cargos[$i])
                && !empty($encargados[$i])
                && !empty($emails[$i])) {
                $conv_notification = new ConvocatoriaNotificacion();
                $conv_notification->convocatoria_id = $this->object->getId();
                $conv_notification->cargo = $cargos[$i];
                $conv_notification->encargado = $encargados[$i];
                $conv_notification->email= $emails[$i];
                $conv_notification->save();
            }
        }

        $this->getUser()->setFlash('success', 'La configuración de las' .
            ' notificaciones ha sido registrada.');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $this->object->getId())) . '#viewers');
    }

    public function executeCargos(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $roles = $request->getParameter('roles');

        $this->object->removeRoles();

        foreach ($roles as $id_group => $users) {
            $users = array_unique($users);
            foreach ($users as $id_user) {
                $usuario = new UsuarioGrupoConvocatoria();
                $usuario->user_id = $id_user;
                $usuario->grupo_id = $id_group;
                $usuario->convocatoria_id = $this->object->getId();
                $usuario->save();
            }
        }

        $this->getUser()->setFlash('success', 'La configuración de los' .
            ' cargos ha sido registrada.');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $this->object->getId())) . '#users');
    }

    // method for generalization of actions over convocatorias or whatever.
    private function actionChange($action) {
        $object = $this->getRoute()->getObject();
        $message = $object->executeTransform($action);
        $this->getUser()->setFlash('notice', $message);
    }

    private function emailTitle($operation) {
        $this->object = $this->getRoute()->getObject();
        $tpl = 'Sistema de Convocatorias [convocatoria %s fue %s]';
        return sprintf($tpl, $this->object->getGestion(), $operation);
    }

    private function emailContent($operation) {
        $this->object = $this->getRoute()->getObject();
        return $this->getPartial(
            'convocatorias/email_notification',
            array(
                'convocatoria' => $this->object,
                'user' => $this->getUser(),
                'operation' => $operation,
            ));
    }

    private function emailNotification($title, $content) {
        $this->object = $this->getRoute()->getObject();

        // notifications of subscribers
        $subscribers = $this->object->getNotificaciones();
        $to = array();
        foreach ($subscribers as $subscriber) {
            $to[$subscriber->getEmail()] = $subscriber->getEncargado();
        }

        if (!empty($to)) {
            $message = Swift_Message::newInstance()
                ->setFrom(
                    sfConfig::get('app_sf_guard_plugin_default_from_email'))
                ->setTo($to)
                ->setSubject($title)
                ->setBody($content)
                ->setContentType('text/html');

            try {
                $this->getMailer()->send($message);
            } catch (Exception $e) {}
            // Transporm exception, who care
        }
    }

    // state transition (eliminar)
    public function executeEliminar() {
        $this->emailNotification(
            $this->emailTitle('eliminada'),
            $this->emailContent('eliminada')
        );

        $this->actionChange('eliminar');
        $this->redirect($this->_route_list);
    }

    // state transition (promover)
    public function executePromover() {
        $this->object = $this->getRoute()->getObject();
        if ($this->object->getEstado() == 'borrador') {
            $title = 'emitida';
        } else {
            $title = 'publicada';
        }

        $this->emailNotification(
            $this->emailTitle($title),
            $this->emailContent($title)
        );

        $this->actionChange('promover');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $this->object->getId())) . '#preview');
    }

    public function executeAnular() {
        $this->emailNotification(
            $this->emailTitle('anulada'),
            $this->emailContent('anulada')
        );

        $this->actionChange('anular');
        $this->redirect($this->_route_list);
    }

    public function executeFinalizar() {
        $this->object = $this->getRoute()->getObject();
        $this->emailNotification(
            $this->emailTitle('finalizada'),
            $this->emailContent('finalizada')
        );

        $this->actionChange('finalizar');
        $this->redirect($this->generateUrl('convocatorias_show', array(
            'id' => $this->object->getId())) . '#preview');
    }

    public function executePostular($request) {
        $this->executeShow($request);

        $form = new PostulanteForm();
        if ($request->isMethod('post')) {
            $form->bind(
                $request->getParameter($form->getName()),
                $request->getFiles($form->getName())
            );

            if ($form->isValid()) {
                $form->setConvocatoria($this->object);
                $form->save();

                $this->getUser()->setFlash('success', 'Postulación exitosa');
                $this->redirect($this->generateUrl('convocatorias_show', array(
                    'id' => $this->object->getId())));
            }

            $this->getUser()->setFlash('error',
                'Se encontraron algunos errores en el formulario');
        }

        $this->postulants = $form;
        $this->tab_click = 'postulants';
        $this->setTemplate('show');
    }
}
