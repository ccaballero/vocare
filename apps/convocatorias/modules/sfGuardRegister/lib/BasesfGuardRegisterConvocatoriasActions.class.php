<?php

/*
 * 
 */
class BasesfGuardRegisterConvocatoriasActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }

    $this->form = new sfGuardRegisterForm();
    
    
    
    /*Demasiado lio para tener que agregar solo esta linea :/ */
     $this->form->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('sf_guard.es');  
     
     
     
     
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $user = $this->form->save();
        $this->getUser()->signIn($user);

        $this->redirect('@homepage');
      }
    }
  }
}

?>
