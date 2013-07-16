<?php

class documentacionActions extends PlantillasDefault
{
    public $_table = 'DocumentacionVolumen';
    public $_form = 'DocumentacionVolumenForm';
    public $_route_list = 'documentacion';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar volumen de documentación',
            'edit' => 'Editar propiedades del volumen',
        ),
        'flash' => array(
            'new' => 'Volumen agregado exitosamente',
            'edit' => 'Volumen editado exitosamente',
            'delete' => 'Volumen eliminado exitosamente',
        ),
    );

    public function executeShow(\sfWebRequest $request) {
        $volumen = $this->getRoute()->getObject();
        $this->forward404Unless($volumen);

        $this->object = $volumen;
        $this->docs = $volumen->getDocumentaciones();
        $this->previews = $volumen->renderXHTML();
    }

    public function executeEditar(sfWebRequest $request) {
        $volumen = $this->getRoute()->getObject();

        $holder = $request->getParameterHolder();
        $all = $holder->getAll();

        foreach ($all as $key => $element) {
            switch ($key) {
                case 'volumen':
                    $volumen->setNombre($request->getParameter($key));
                    break;
                case 'common':
                    $common = json_encode($request->getParameter($key));
                    $volumen->setVars($common);
                    break;
            }
        }

        $volumen->save();

        $this->getUser()->setFlash('success',
            'La información de documentación ha sido registrada');
        $this->redirect($this->generateUrl('documentacion_show', array(
            'id' => $volumen->getId())));
    }
}
