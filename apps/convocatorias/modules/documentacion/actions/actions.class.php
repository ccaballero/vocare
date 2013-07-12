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
    
    public function executeRedaccion(sfWebRequest $request) {
        $volumen = $this->getRoute()->getObject();
        
        $common = $request->getParameter('common');
//        while() {
        
//        $vars = $request->getParameter
//        var_dump($vars);
//        die;
    }
}
