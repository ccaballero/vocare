<?php

class FormProfile extends sfForm
{
    public function configure() {
        $this->setWidgets(array(
            'first_name' => new sfWidgetFormInputText(),
            'last_name' => new sfWidgetFormInputText(),
            'email_address' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'first_name' => new sfValidatorString(
                array('max_length' => 255, 'required' => false)),
            'last_name' => new sfValidatorString(
                array('max_length' => 255, 'required' => false)),
            'email_address' => new sfValidatorString(
                array('max_length' => 255)),
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorAnd(array(
                new sfValidatorDoctrineUnique(array(
                    'model' => 'sfGuardUser',
                    'column' => array('email_address'))),
            new sfValidatorDoctrineUnique(array(
                    'model' => 'sfGuardUser',
                    'column' => array('username'))),
        )));

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->widgetSchema->setLabels(array(
            'first_name' => 'Nombres:',
            'last_name' => 'Nombres:',
            'email_address' => 'Correo electrónico (*):',
        ));

        $this->widgetSchema['first_name']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
