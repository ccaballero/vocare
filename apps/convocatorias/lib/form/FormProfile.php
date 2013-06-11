<?php

class FormProfile extends BasesfGuardUserForm
{
    public function setup() {
        parent::setup();

        $this->useFields(array('email_address', 'first_name', 'last_name'));

        $this->widgetSchema['email_address'] = new sfWidgetFormInputText();
        $this->widgetSchema['first_name'] = new sfWidgetFormInputText();
        $this->widgetSchema['last_name'] = new sfWidgetFormInputText();

        $this->validatorSchema['email_address'] = new sfValidatorString(
                array('max_length' => 255, 'required' => true));
        $this->validatorSchema['first_name'] = new sfValidatorString(
                array('max_length' => 255, 'required' => false));
        $this->validatorSchema['last_name'] = new sfValidatorString(
                array('max_length' => 255, 'required' => false));

        $this->mergePostValidator(
            new sfValidatorDoctrineUnique(array(
                'model' => 'sfGuardUser',
                'primary_key' => 'id',
                'column' => array('email_address')))
        );
    }

    public function configure() {
        $this->widgetSchema->setLabels(array(
            'email_address' => 'Correo electrónico (*):',
            'first_name' => 'Nombres:',
            'last_name' => 'Apellidos:',
        ));

        $this->widgetSchema['email_address']->setAttribute('class', 'focus');

  	$decorator = new FormDecoratorDefault($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('custom', $decorator);
  	$this->widgetSchema->setFormFormatterName('custom');
    }
}
