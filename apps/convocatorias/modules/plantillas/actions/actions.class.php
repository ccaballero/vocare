<?php

class plantillasActions extends PlantillasDefault
{
    public $_table = 'plantilla';
    public $_form = 'PlantillaForm';
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
        $this->taxonomy = $this->object->getTaxonomy();

        $this->forward404Unless($this->object);
    }

    public function executeClonar(sfWebRequest $request) {
        $object = $this->getRoute()->getObject();

        $plantilla = new Plantilla();
        $plantilla->nombre = $object->getNombre() . ' (duplicado)';
        $plantilla->redaccion = $object->getRedaccion();
        $plantilla->types = $object->getTypes();
        $plantilla->save();

        $this->getUser()->setFlash('success', 'La plantilla de documentación '
                . 'a sido duplicada exitosamente');

        $this->redirect($this->_route_list);
    }

    public function executeTypes() {
        $object = $this->getRoute()->getObject();
        $this->forward404Unless($object);

//        $cargos = $request->getParameter('cargos');
        
        $this->getUser()->setFlash('success', 'Los tipos de datos han sido '
                . 'modificados exitosamente');

        $this->redirect($this->generateUrl('plantillas_show', array(
            'id' => $object->getId())));
    }
}
