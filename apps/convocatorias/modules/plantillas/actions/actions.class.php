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
        $this->redaction = $this->object->getRedaction();
        $this->taxonomy = Xhtml::taxonomy($this->object->getRedaction());

        $this->forward404Unless($this->object);
    }

    public function executeClonar(sfWebRequest $request) {
        $object = $this->getRoute()->getObject();

        $template = new DocumentacionPlantilla();
        $template->label = $object->getLabel() . ' (duplicado)';
        $template->redaction = $object->getRedaction();
        $template->types = $object->getTypes();
        $template->save();

        $this->getUser()->setFlash('success', 'La plantilla de documentación '
                . 'a sido duplicada exitosamente');

        $this->redirect($this->_route_list);
    }
}
