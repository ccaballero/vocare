<?php

require_once 'autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(
        array(
            'sfDoctrinePlugin',
            'sfDoctrineGuardPlugin',
        )
    );
  }
}
