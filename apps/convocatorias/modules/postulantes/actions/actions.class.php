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
        parent::executeEdit($request);
    }

    public function executeUpdate(\sfWebRequest $request) {
        $this->convocatoria = $this->getConvocatoria($request);
        $this->_route_list = $this->generateUrl('postulantes', array(
            'convocatoria' => $this->convocatoria));

        parent::executeUpdate($request);
    }
}