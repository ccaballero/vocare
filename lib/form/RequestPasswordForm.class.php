<?php

//require_once(sfConfig::get('sf_plugins_dir')
//    . '/sfDoctrineGuardPlugin/modules/sfGuardForgotPassword/'
//    . 'lib/form/sfGuardRequestForgotPasswordForm.class.php'
//);

class RequestPasswordForm extends sfGuardRequestForgotPasswordForm
{
    public function configure() {
        $this->widgetSchema->setLabels(array(
            'email_address' => 'Correo electrónico (*):',
        ));

        $this->widgetSchema['email_address']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');    
    }
}
