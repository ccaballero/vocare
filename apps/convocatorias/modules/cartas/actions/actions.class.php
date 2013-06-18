<?php

class cartasActions extends PlantillasDefault
{
    public $_table = 'carta';
    public $_form = 'CartaForm';
    public $_route_list = 'cartas';
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

    public function executeShow(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $this->redaccion = $this->object->getRedaccion();
        $this->taxonomy = $this->object->getTaxonomy();

        $this->forward404Unless($this->object);
    }
}
