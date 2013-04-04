<?php

class sfGuardCustomFormSignin extends sfGuardFormSignin
{
    public function configure(){
        parent::configure();

        $this->widgetSchema['username']->setAttribute('class', 'focus');

        $decorator = new FormDecoratorDefault($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $decorator);
        $this->widgetSchema->setFormFormatterName('custom');
    }
}
