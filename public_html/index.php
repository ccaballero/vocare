<?php

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . '../lib' . DIRECTORY_SEPARATOR . 'symfony');
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('convocatorias', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
