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
            'permission' => 'No se tienen los permisos suficientes',
            'expired' => 'El tiempo establecido para esta función ha expirado',
            'filter' =>
                'No existen postulantes bajo las condiciones de filtraje',
        ),
    );

    public $columns = array(
        'number' => 'Nro',
        'fullname' => 'Nombre Completo',
        'email' => 'Correo Electrónico',
        'status' => 'Estado',
        'numero_hojas' => 'Numero de Hojas',
        'fecha_entrega' => 'Fecha de Entrega',
        'hora_entrega' => 'Hora de Entrega',
        'requerimientos' => 'Requerimientos',
        'requisitos' => 'Requisitos',
        'documentos' => 'Documentos',
        'observaciones' => 'Observaciones',
    );
    public $filters = array(
        'items' => 'Requerimientos',
//        'evaluations' => 'Evaluaciones',
        'status' => 'Estados',
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

    public function executeIndex(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);

        // tabs renderization
        $this->tabs = array(
            'all' => true,
            'reception' => $this->getUser()->hasPermissionConvocatoria(
                $this->convocatoria, 'recepcion_postulante'),
            'habilitation' => $this->getUser()->hasPermissionConvocatoria(
                $this->convocatoria, 'evaluacion_postulante'),
            'reports' => $this->getUser()->hasPermissionConvocatoria(
                $this->convocatoria, 'reporte_postulante'),
        );

        $this->tab_click = 'all';

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
        return array(
            'convocatoria' => $convocatoria,
            'columns' => $this->columns,
            'filters' => $this->filters,
        );
    }

    // TODO: hacer algo con los hashes invalidos, algo menos rudo que un 404
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

    public function executeDelete(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria->getId()));

        if ($this->getUser()
                 ->hasPermissionConvocatoria(
                     $this->convocatoria, 'eliminar_postulante')) {
            parent::executeDelete($request);
        } else {
            $this->getUser()->setFlash('error',
                $this->_messages['flash']['permission']);
            $this->redirect($this->_route_list);
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->object = $this->getRoute()->getObject();
        $this->title = 'Modificación de los datos del postulante';

        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria));

        if ($this->getUser()
                 ->hasPermissionConvocatoria(
                     $this->convocatoria, 'edicion_postulante')) {
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
        } else {
            $this->getUser()->setFlash('error',
                $this->_messages['flash']['permission']);
            $this->redirect($this->_route_list);
        }
    }

    public function executeReception(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->object = $this->getRoute()->getObject();

        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria));

        if (!$this->getUser()->hasPermissionConvocatoria(
                $this->convocatoria, 'recepcion_postulante')) {
            $this->getUser()->setFlash('error',
                $this->_messages['flash']['permission']);
            $this->redirect($this->_route_list);
        }

        if (!$this->convocatoria->checkEvent('end-documents')) {
            $this->getUser()->setFlash('error',
                $this->_messages['flash']['expired']);
            $this->redirect($this->_route_list);
        }

        $this->title = 'Formulario de recepción de postulación';
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

        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria));

        if (!$this->getUser()
                 ->hasPermissionConvocatoria(
                     $this->convocatoria, 'evaluacion_postulante')) {
            $this->getUser()->setFlash('error',
                $this->_messages['flash']['permission']);
            $this->redirect($this->_route_list);
        }

        if (!$this->convocatoria->checkEvent('end-habilitations')) {
            $this->getUser()->setFlash('error',
                $this->_messages['flash']['expired']);
            $this->redirect($this->_route_list);
        }

        $this->title = 'Formulario de habilitación';
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
        $this->executeIndex($request);
        $convocatoria = $this->getConvocatoria($request);

        if ($this->getUser()
                 ->hasPermissionConvocatoria(
                     $this->convocatoria, 'reporte_postulante')) {
            if ($request->isMethod('post')) {
                $orientation = $request->getParameter('orientation', 'L');

                $columns = $request->getParameter(
                    'columns', array('number', 'fullname'));
                $_columns = $this->columns;
                foreach ($_columns as $key => $column) {
                    $_columns[$key] =
                        (array_search($key, $columns) === false) ? false : true;
                }

                $filters = $request->getParameter('filters', array());
                $f_items =
                    isset($filters['items']) ? $filters['items'] : array();
                $f_evaluations =
                    isset($filters['evaluations']) ?
                        $filters['evaluations'] : array();
                $f_status =
                    isset($filters['status']) ? $filters['status'] : array();
                $postulantes = Doctrine::getTable('Postulante')
                    ->selectByFilters($convocatoria,
                        $f_items, $f_evaluations, $f_status);

                if (count($postulantes) == 0) {
                    $this->getUser()->setFlash('error',
                        $this->_messages['flash']['filter']);
                    $this->redirect($this->generateUrl(
                        'postulantes', array(
                            'convocatoria' => $convocatoria->getId()
                        )) . '#reports');
                }

                $pdf = new TCPDF($orientation, 'mm', 'LETTER', true, 'UTF-8');
                $pdf->setMargins(10, 20, 10, true);
                $pdf->setAutoPageBreak(true, 13);
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);

                $pdf->setFont('times', '', '11');
                $pdf->addPage();

                $content = $this->getPartial('table',
                    array(
                        'convocatoria' => $convocatoria,
                        'postulantes' => $postulantes,
                        'requerimientos' => $convocatoria
                                         ->getConvocatoriaRequerimientos(),
                        'requisitos' => $convocatoria
                                     ->getConvocatoriaRequisitos(),
                        'documentos' => $convocatoria
                                     ->getConvocatoriaDocumentos(),
                        'columns' => $_columns,
                        'second' => $_columns['requerimientos']
                                 || $_columns['requisitos']
                                 || $_columns['documentos'],
                    )
                );

                $pdf->writeHTML($content);
                $pdf->output('postulantes-'
                    . $convocatoria->getGestion() . '.pdf');

                return sfView::NONE;
            }
        } else {
            $this->getUser()->setFlash('error',
                $this->_messages['flash']['permission']);
            $this->redirect($this->_route_list);
        }

        $this->tab_click = 'reports';
        $this->setTemplate('index');
    }
}
