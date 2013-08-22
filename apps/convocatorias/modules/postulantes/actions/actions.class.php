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
        if (!$this->getUser()->canView($convocatoria)
            || !$convocatoria->esVigente()) {
            $this->forward404();
        }

        return $convocatoria;
    }

    public function executeIndex(sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);

        // tabs renderization
        $this->tabs = array(
            'list' => true,
            'reception' => true,
            'habilitation' => true,
        );
        $this->tab_click = 'list';

        if ($this->tabs['list']) {
            $this->postulants =
                $this->_renderListPostulants($this->convocatoria);
        }
    }

    protected function _renderListPostulants($convocatoria) {
        return array(
            'postulantes' =>
                Doctrine::getTable('Postulante')
                    ->findByConvocatoria($convocatoria),
            'requerimientos' => $convocatoria->getConvocatoriaRequerimientos(),
            'convocatoria' => $convocatoria,
        );
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
