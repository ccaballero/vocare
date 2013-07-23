<?php

class plantillasActions extends PlantillasDefault
{
    public $_table = 'DocumentacionPlantilla';
    public $_form = 'DocumentacionPlantillaForm';
    public $_route_list = 'plantillas';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar plantilla de documentación',
            'edit' => 'Editar plantilla de documentación',
        ),
        'flash' => array(
            'new' => 'Plantilla agregada exitosamente',
            'edit' => 'Plantilla editada exitosamente',
            'delete' => 'Plantilla eliminada exitosamente',
        ),
    );

    public function executeShow(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $this->redaccion = $this->object->getRedaccion();
        $this->taxonomy = Xhtml::taxonomy($this->object->getRedaccion());

        $this->forward404Unless($this->object);
    }

    public function executeClonar(sfWebRequest $request) {
        $object = $this->getRoute()->getObject();

        $plantilla = new DocumentacionPlantilla();
        $plantilla->nombre = $object->getNombre() . ' (duplicado)';
        $plantilla->redaccion = $object->getRedaccion();
        $plantilla->types = $object->getTypes();
        $plantilla->save();

        $this->getUser()->setFlash('success', 'La plantilla de documentación '
                . 'a sido duplicada exitosamente');

        $this->redirect($this->_route_list);
    }
}
