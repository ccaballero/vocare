<?php

class postulantesActions extends PlantillasDefault
{
    public $_table = 'postulante';
    public $_form = 'PostulanteForm';
    public $_route_list = '@postulantes';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar postulante',
            'edit' => 'Editar postulante',
        ),
        'flash' => array(
            'new' => 'Postulante agregado exitosamente',
            'edit' => 'Postulante editado exitosamente',
            'delete' => 'Postulante eliminado exitosamente',
        ),
    );

    protected function getConvocatoria(sfWebRequest $request) {
        $id_convocatoria = $request->getParameter('convocatoria');
        $convocatoria =
            Doctrine::getTable('Convocatoria')->find($id_convocatoria);

        // Existence validation
        $this->forward404Unless($convocatoria);

        // State validation
        if ($convocatoria->esVigente()
                || $this->getUser()->canView($convocatoria)) {
            return $convocatoria;
        }

        $this->forward404();
    }

    public function executeDelete(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria->getId()));

        parent::executeDelete($request);
    }

    public function executeIndex(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);

        // tabs renderization
        $this->tabs = array(
            'all' => true,
            'reception' => true,
            'habilitation' => true,
            'reports' => true,
        );
        $this->tab_click = 'reports';

        if ($this->tabs['all']) {
            $this->all =
                $this->_renderListPostulants($this->convocatoria);
        }
        if ($this->tabs['reception']) {
            $this->reception =
                $this->_renderListPostulants(
                    $this->convocatoria, array(
                        'pendiente', 'inscrito', 'habilitado', 'inhabilitado'));
        }
        if ($this->tabs['habilitation']) {
            $this->habilitation =
                $this->_renderListPostulants(
                    $this->convocatoria,
                    array('inscrito', 'habilitado', 'inhabilitado'));
        }
        if ($this->tabs['reports']) {
            $this->reports =
                $this->_renderReports($this->convocatoria);
        }
    }

    protected function _renderListPostulants($convocatoria, $state = array()) {
        if (empty($state)) {
            $postulantes = Doctrine::getTable('Postulante')
                ->findByConvocatoria($convocatoria);
        } else {
            $postulantes = Doctrine::getTable('Postulante')
                ->findByConvocatoriaAndState($convocatoria, $state);
        }

        return array(
            'requerimientos' => $convocatoria->getConvocatoriaRequerimientos(),
            'requisitos' => $convocatoria->getConvocatoriaRequisitos(),
            'documentos' => $convocatoria->getConvocatoriaDocumentos(),
            'convocatoria' => $convocatoria,
            'postulantes' => $postulantes,
        );
    }

    public function _renderReports($convocatoria) {
        $columns = array(
            'count' => array('Nro', ''),
            'fullname' => array('Nombre Completo', 'getFullname'),
            'email' => array('Correo Electrónico', 'getCorreoElectronico'),
            'status' => array('Estado', 'getEstado'),
            'numero_hojas' => array('Numero de Hojas', ''),
            'fecha_entrega' => array('Fecha de Entrega', ''),
            'hora_entrega' => array('Hora de Entrega', ''),
            'requerimientos' => array('Requerimientos', ''),
            'requisitos' => array('Requisitos', ''),
            'documentos' => array('Documentos', ''),
            'observaciones' => array('Observaciones', ''),
        );

        $filters = array(
            'all' => array('Todos', ''),
        );

        return array(
            'convocatoria' => $convocatoria,
            'columns' => $columns,
            'filters' => $filters,
        );
    }

    public function executeConfirm(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);

        $id = $request->getParameter('id');
        $hash = $request->getParameter('hash');

        $this->postulante =
            Doctrine::getTable('Postulante')->findByConfirmation($id, $hash);

        // Existence validation
        $this->forward404Unless($this->postulante);

        $this->postulante->setEstado('pendiente');
        $this->postulante->save();
    }

    public function executeEdit(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->object = $this->getRoute()->getObject();
        $this->title = 'Modificación de los datos del postulante';

        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria));

        $this->form = new $this->_form($this->object);
        $this->form->setConvocatoria($this->convocatoria);
        $this->url = 'postulantes_edit';
        $this->information = false;

        if ($request->isMethod('post')) {
            $this->form = $this->processForm(
                $request,
                $this->form,
                $this->_messages['flash']['edit']
            );
        }

        $this->setTemplate('form');
    }

    public function executeReception(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->object = $this->getRoute()->getObject();
        $this->title = 'Formulario de recepción de postulación';

        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria));

        $this->form = new PostulanteReceptionForm($this->object);
        $this->form->setConvocatoria($this->convocatoria);
        $this->url = 'postulantes_reception';
        $this->information = true;

        if ($request->isMethod('post')) {
            $this->form = $this->processForm(
                $request,
                $this->form,
                $this->_messages['flash']['edit']
            );
        }

        $this->setTemplate('form');
    }

    public function executeHabilitation(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->object = $this->getRoute()->getObject();
        $this->title = 'Formulario de habilitación';

        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria));

        $this->form = new PostulanteHabilitationForm($this->object);
        $this->form->setConvocatoria($this->convocatoria);
        $this->url = 'postulantes_habilitation';
        $this->information = true;

        if ($request->isMethod('post')) {
            $this->form = $this->processForm(
                $request,
                $this->form,
                $this->_messages['flash']['edit']
            );
        }

        $this->setTemplate('form');
    }

    public function executeReport(sfWebRequest $request) {
        $convocatoria = $this->getConvocatoria($request);
        $postulantes = Doctrine::getTable('Postulante')
                     ->findByConvocatoria($convocatoria);

        $pdf = new TCPDF('L', 'mm', 'LETTER', true, 'UTF-8');
        $pdf->setMargins(10, 20, 10, true);
        $pdf->setAutoPageBreak(true, 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->setFont('times', 'B', 13);
        $pdf->write(0, 'Postulantes ' . $convocatoria->getGestion(), '', 0, 'C', true, 0, false, false, 0);
        $pdf->ln();

        $pdf->setTextColor(0, 0, 0);

        $header = array('Nro.', 'Nombre Completo', 'Correo electrónico', 'Estado', 'Observaciones');
        $w = array(5, 40, 20, 15, 20);
        $_w = 249.4;

        for($i = 0; $i < count($header); ++$i) {
            $pdf->cell($_w * ($w[$i] / 100.0), 0, $header[$i], 'B', 0, 'C', false);
        }
        $pdf->ln();

        $pdf->setFont('times', '', 12);

        foreach ($postulantes as $key => $postulante) {
            $pdf->multiCell($w[0] * ($_w / 100.0), 0, ($key + 1),
                0, 'R', false, 0, '', '', true, 0, false, true, 0, 'T', true);
            $pdf->multiCell($w[1] * ($_w / 100.0), 0, $postulante->getFullname(),
                0, 'L', false, 0, '', '', true, 0, false, true, 0, 'T', true);
            $pdf->multiCell($w[2] * ($_w / 100.0), 0, $postulante->getCorreoElectronico(),
                0, 'C', false, 0, '', '', false);
            $pdf->multiCell($w[3] * ($_w / 100.0), 0, $postulante->getEstado(),
                0, 'C', false, 0, '', '', false);
            $pdf->multiCell($w[4] * ($_w / 100.0), 0, $postulante->getObservacion(),
                0, 'L', false, 1, '', '', false);
        }

        $pdf->output();

        return sfView::NONE;
    }
}
