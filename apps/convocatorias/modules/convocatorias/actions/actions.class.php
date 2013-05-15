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
        $this->cargos = $cargos->listAll();
        
        $this->view_preview = true;
        $this->view_editor = ($state == 'borrador') || ($state == 'emitido');
        $this->view_redaction = ($state == 'borrador') || ($state == 'emitido');
        $this->view_viewers = ($state == 'borrador' || ($state == 'emitido'));
        $this->view_users = ($state == 'borrador' || ($state == 'emitido'));
        $this->view_results = ($state == 'vigente') || ($state == 'finalizado');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $flash = '') {
        $form->setRequerimientos($request->getParameter('requerimientos'));
        $form->setRequisitos($request->getParameter('requisitos'));
        $form->setDocumentos($request->getParameter('documentos'));
        $form->setEventos($request->getParameter('eventos'));

        return parent::processForm($request, $form, $flash);
    }

    public function executeTexto() {
        $convocatoria = $this->getRoute()->getObject();
        $numero_enmienda = $convocatoria->getMaxEnmienda();

        $dirbase1 = sfConfig::get('app_dir_generation');
        $filename1 = $convocatoria->getId() . '_' . $numero_enmienda . '.xml';

        $dirbase2 = sfConfig::get('app_xslt_transforms');
        $filename2 = 'transform-text.xslt';

        $xslDoc = new DOMDocument();
        $xslDoc->load("$dirbase2/$filename2");

        $xmlDoc = new DOMDocument();
//        $xmlDoc->load("$dirbase1/$filename1");
        $xmlDoc->loadXML(str_replace('&nbsp;', '', file_get_contents("$dirbase1/$filename1")));

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);

        try {
            ob_start();
            $proc->transformToURI($xmlDoc, 'php://output');
            $output = ob_get_contents();
            ob_clean();

            $this->setLayout(false);
            sfConfig::set('sf_web_debug', false);

            $this->getResponse()->clearHttpHeaders();
            $this->getResponse()->setHttpHeader('Pragma: public', true);
            $this->getResponse()->setContentType('text/plain; charset=utf-8');

            $this->getResponse()->sendHttpHeaders();
            $this->getResponse()->setContent($output);
        } catch (Exception $e) {
            $e->printStackTrace();
        }

        return sfView::NONE;
    }

    public function executePdf() {
        $object = $this->getRoute()->getObject();

        $latex_dir = realpath(APPLICATION_PATH . '/data/tex/convocatorias');
        $pdflatex_path = '/usr/bin/pdflatex';

        $tex_file = $latex_dir . DIRECTORY_SEPARATOR . $object->getId() . '.tex';
        $pdf_file = $latex_dir . DIRECTORY_SEPARATOR . $object->getId() . '.pdf';

        exec($pdflatex_path . ' -output-directory ' . $latex_dir . ' ' . $tex_file);

        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        $this->forward404Unless(file_exists($pdf_file));

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="convocatoria.pdf' . '"');
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

        $this->getUser()->setFlash('notice', 'La redacción de la convocatoria acaba de ser editada');
        $this->redirect($this->generateUrl('convocatorias_show', array('id' => $convocatoria->getId())));
    }

    // method for generalization of actions over convocatorias or whatever you are.
    private function actionChange($action) {
        $object = $this->getRoute()->getObject();
        $message = $object->executeTransform($action);
        $this->getUser()->setFlash('notice', $message);
        $this->redirect($this->_route_list);
    }

    public function executeEliminar() {
        $this->actionChange('eliminar');
    }

    public function executePromover() {
        $this->actionChange('promover');

        // Dos tipos de promover.

        // PROMOVER PARA QUE SEA EMITIDA
        // Controlar que se tenga una redaccion basica
        // Asignar roles a usuarios encargados de las distintas actividades

        // PROMOVER PARA QUE SEA VIGENTE
        // Hacer que la convocatoria no tenga permisos para ser editada.
        // Notificar a estos usuarios sobre los diferentes eventos del proceso
        // Publicar la convocatoria en la pagina principal
    }

    public function executeAnular() {
        $this->actionChange('anular');

        // Notificar a los usuarios de la anulacion de la convocatoria
        // Notificar a los postulantes, si es que existen, acerca de la anulacion
    }

    public function executeFinalizar() {
        $this->actionChange('finalizar');

        // Despublicar la convocatoria de la pagina principal
    }
}
