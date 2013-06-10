<?php

class portadaActions extends sfActions
{
    public function executeIndex(sfWebRequest $request) {
        $convocatoria = new Convocatoria();
        $this->vigentes = $convocatoria->listByState('vigente');
        $this->finalizadas = $convocatoria->listByState('finalizado', 3);
    }

    public function executeConvocatorias() {
        $convocatoria = new Convocatoria();
        $this->convocatorias = $convocatoria->listVisibles();
    }

    public function executePlantillas(sfWebRequest $request) {}
    public function executePersonal(sfWebRequest $request) {}

    public function executePerfil(sfWebRequest $request) {
        $profile = new FormProfile();
        $this->form = $profile;
    }
}
