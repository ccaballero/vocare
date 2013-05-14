<?php

class cargosActions extends PlantillasDefault
{
    public $_table = 'cargo';
    public $_form = 'CargoForm';
    public $_route_list = 'cargos';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar cargo',
            'edit' => 'Editar cargo',
        ),
        'flash' => array(
            'new' => 'Cargo agregado exitosamente',
            'edit' => 'Cargo editado exitosamente',
            'delete' => 'Cargo eliminado exitosamente',
        ),
    );

    public function executeShow(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $this->forward404Unless($this->object);

        $this->list = $this->object->getEncargados();

        $this->form = new CargoEncargadoForm();
    }

    public function executeAgregar(sfWebRequest $request) {
        $this->object = $this->getRoute()->getObject();
        $this->list = $this->object->getEncargados();
        $this->_route_list = $this->generateUrl('cargos_show', $this->object);
        
        $encargado = new CargoEncargado();
        $encargado->cargo_id = $this->object->getId();
        $encargado->fecha = date('Y-m-d');
        
        $form = new CargoEncargadoForm($encargado);
        
        $this->form = $this->processForm(
            $request,
            $form,
            'El encargado nuevo ha sido registrado'
        );
        
        $this->setTemplate('show');
    }
}
