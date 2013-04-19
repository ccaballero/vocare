<?php

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
if (!in_array(@$_SERVER['REMOTE_ADDR'], array('167.157.26.129', '127.0.0.1', '::1')))
{
  die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

defined('APPLICATION_PATH') ||
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . '../lib' . DIRECTORY_SEPARATOR . 'symfony');
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('convocatorias', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
