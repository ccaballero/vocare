<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardRegister/lib/BasesfGuardRegisterComponents.class.php');

class BasesfGuardRegisterConvocatoriasComponents extends  sfComponents 
{
    public function executeForm()
    {
         $this->form = new sfGuardRegisterForm();
         $this->form->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('sf_guard.es');    
    }
}
?>
