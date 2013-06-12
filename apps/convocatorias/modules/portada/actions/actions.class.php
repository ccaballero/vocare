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
    public function executeDocumentacion(sfWebRequest $request) {}

    public function executePerfil(sfWebRequest $request) {
        $user = $this->getUser();

        $this->settings = new FormProfile($user->getGuard());
        $this->passwd = new ChangePasswordForm($user->getGuard());

        if ($request->isMethod('post')) {
            $type = $request->getParameter('type');
            switch ($type) {
                case 'settings':
                    $form = $this->settings;
                    $form->bind($request->getParameter($form->getName()));
                    if ($form->isValid()) {
                        $form->save();
                        $this->getUser()->setFlash('success',
                            'Sus datos fueron actualizados correctamente');
                        $this->redirect('@profile');
                    } else {
                        $this->getUser()->setFlash('error',
                            'Se encontraron algunos errores en el formulario');
                    }
                    break;
                case 'passwd':
                    $form = $this->passwd;
                    $form->bind($request->getParameter($form->getName()));
                    if ($form->isValid()) {
                        $form->save();
                        $this->getUser()->setFlash('success',
                            'Su contraseña ha sido cambiada correctamente');
                        $this->redirect('@profile');
                    } else {
                        $this->getUser()->setFlash('error',
                            'Se encontraron algunos errores en el formulario');
                    }
                    break;
            }
        }
    }
}
