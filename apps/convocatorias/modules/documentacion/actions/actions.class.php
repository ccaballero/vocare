<?php

class documentacionActions extends PlantillasDefault
{
    public $_table = 'DocumentacionVolumen';
    public $_form = 'DocumentacionVolumenForm';
    public $_route_list = 'documentacion';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar documento',
            'edit' => 'Editar documento',
        ),
        'flash' => array(
            'new' => 'Documento agregado exitosamente',
            'edit' => 'Documento editado exitosamente',
            'delete' => 'Documento eliminado exitosamente',
        ),
    );
    
    public function executeShow(\sfWebRequest $request) {
        $volumen = $this->getRoute()->getObject();
        $this->forward404Unless($volumen);
        
        $this->object = $volumen;
        $this->previews = $volumen->renderXHTML();
    }
}
