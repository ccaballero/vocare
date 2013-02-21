<?php

class convocatoriasActions extends sfActions
{
    public function executeIndex(sfWebRequest $request) {
        $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('Convocatoria c')
            ->orderBy('c.updated_at');

        $this->list = $q->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new ConvocatoriaForm();
        
        $this->object = $this->getRoute()->getObject();
        $this->forward404Unless($this->object);
    }
}
