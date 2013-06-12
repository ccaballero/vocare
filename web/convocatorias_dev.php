<?php

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
//if (!in_array(@$_SERVER['REMOTE_ADDR'], array('167.157.26.129', '127.0.0.1', '::1')))
//{
//  die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
//}

define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));

$symfony_libraries = APPLICATION_PATH . '/symfony/lib';
$configuration_file = '/config/ProjectConfiguration.class.php';
$deploy_possibilities = array(
    'production' => APPLICATION_PATH . '/vocare' . $configuration_file,
    'development' => APPLICATION_PATH . $configuration_file,
);

// checking existence
if (file_exists($symfony_libraries)) {
    ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . $symfony_libraries);
}

foreach ($deploy_possibilities as $possibility) {
    if (file_exists($possibility)) {
        require_once($possibility);
    }
}

$configuration = ProjectConfiguration::getApplicationConfiguration('convocatorias', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
