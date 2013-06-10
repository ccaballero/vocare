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
        $this->vigentes = $convocatoria->listByState('vigente');
        $this->finalizadas = $convocatoria->listByState('finalizado');
    }

    public function executePlantillas(sfWebRequest $request) {}
    public function executePersonal(sfWebRequest $request) {}

    public function executePerfil(sfWebRequest $request) {
        $user = $this->getUser();

        $this->settings = new FormProfile(array(
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email_address' => $user->getEmailAddress(),
        ));
        $this->passwd = new ChangePasswordForm();

        if ($request->isMethod('post')) {
            $type = $request->getParameter('type');
            switch ($type) {
                case 'settings':
                    $form = $this->settings;
                    $form->bind($request->getParameter($form->getName()));
                    if ($form->isValid()) {
                        $this->redirect('portadas/perfil');
                    } else {
                        $this->getUser()->setFlash('notice',
                            'Se encontraron algunos errores en el formulario');
                    }
                    break;
                case 'passwd':
                    $form = $this->passwd;
                    $form->bind($request->getParameter($form->getName()));
                    if ($form->isValid()) {
                        $this->redirect('portadas/perfil');
                    } else {
                        $this->getUser()->setFlash('notice',
                            'Se encontraron algunos errores en el formulario');
                    }
                    break;
            }
        }
    }
}
