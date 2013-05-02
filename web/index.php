<?php

define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));

/*
 * trying to guess the context of the deployment
 * two cases:
 *   case 1: development server
 *     - path: none (in internal path)
 *     - configuration: /../config/ProjectConfiguration.class.php
 *   case 2: production server
 *     - path: /symfony
 *     - configuration: /../vocare/config/ProjectConfiguration.class.php
 */

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

$configuration = ProjectConfiguration::getApplicationConfiguration('convocatorias', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
