<?php

class ChangePasswordForm extends sfGuardChangeUserPasswordForm
{
    public function configure() {
        $this->widgetSchema->setLabels(array(
            'password' => 'Contraseña (*):',
            'password again' => 'Repita su Contraseña (*):',
        ));

        $this->widgetSchema['password']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
