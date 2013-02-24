<?php

class convocatoriasActions extends PlantillasDefault
{
    public $_table = 'convocatoria';
    public $_form = 'ConvocatoriaForm';
    public $_route_list = 'convocatorias';
    public $_messages = array(
        'form' => array(
            'new' => 'Agregar convocatoria',
            'edit' => 'Editar convocatoria',
        ),
        'flash' => array(
            'new' => 'Borrador de convocatoria agregado exitosamente',
            'edit' => 'Borrador de convocatoria editado exitosamente',
            'delete' => 'Borrador de convocatoria eliminado exitosamente',
        ),
    );

    public function executeIndex() {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Convocatoria c')
            ->orderBy('c.updated_at');

        $this->list = $q->execute();
    }

    public function executeShow() {
        $this->form = new ConvocatoriaForm($this->getRoute()->getObject());
        $this->form->removeFocus();

        $this->object = $this->getRoute()->getObject();
        $this->forward404Unless($this->object);
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form, $flash = '') {
        $form->setRequerimientos($request->getParameter('requerimientos'));
        $form->setEventos($request->getParameter('eventos'));
        
        parent::processForm($request, $form, $flash);
    }
}
