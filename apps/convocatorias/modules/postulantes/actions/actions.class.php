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
        );
        $this->tab_click = 'habilitation';

        if ($this->tabs['all']) {
            $this->all =
                $this->_renderListPostulants($this->convocatoria);
        }
        if ($this->tabs['reception']) {
            $this->reception =
                $this->_renderListPostulants(
                    $this->convocatoria, array('pendiente', 'inscrito'));
        }
        if ($this->tabs['habilitation']) {
            $this->habilitation =
                $this->_renderListPostulants(
                    $this->convocatoria,
                    array('inscrito', 'habilitado', 'inhabilitado'));
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
}
