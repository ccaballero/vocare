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
            'list' => true,
            'reception' => true,
            'enabled' => true,
            'disabled' => true,
        );
        $this->tab_click = 'list';

        if ($this->tabs['all']) {
            $this->all =
                $this->_renderListPostulants($this->convocatoria);
        }
        if ($this->tabs['list']) {
            $this->list =
                $this->_renderListPostulants($this->convocatoria, 'pendiente');
        }
        if ($this->tabs['reception']) {
            $this->reception =
                $this->_renderListPostulants($this->convocatoria, 'inscrito');
        }
        if ($this->tabs['enabled']) {
            $this->enabled =
                $this->_renderListPostulants($this->convocatoria, 'habilitado');
        }
        if ($this->tabs['disabled']) {
            $this->disabled =
                $this->_renderListPostulants($this->convocatoria, 'inhabilitado');
        }
    }

    protected function _renderListPostulants($convocatoria, $state = '') {
        if (empty($state)) {
            $postulantes = Doctrine::getTable('Postulante')
                ->findByConvocatoria($convocatoria);
        } else {
            $postulantes = Doctrine::getTable('Postulante')
                ->findByConvocatoriaAndState($convocatoria, $state);
        }

        return array(
            'requerimientos' => $convocatoria->getConvocatoriaRequerimientos(),
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
