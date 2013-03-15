<?php

function obtener_files($dir) {
    $files = array();

    if ($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $files[] = $entry;
            }
        }
    }

    closedir($handle);

    return $files;
}

error_reporting(E_ALL | E_STRICT);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

echo 'test de impresion<br />';

echo 'test de contension: ' . __FILE__ . '<br />';

echo 'test de directorio: ' . dirname(__FILE__) . '<br />';

echo 'test de listaje: <br />';
echo 'case 1: [' . implode('][', obtener_files(dirname(__FILE__))) . '] <br />';
echo 'case 2: [' . implode('][', obtener_files(dirname(__FILE__) . '/../')) . '] <br />';
echo 'case 3: [' . implode('][', obtener_files(dirname(__FILE__) . '/../config/')) . '] <br />';

echo 'prueba de lectura: <br />';
echo 'file: ' . is_file(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php') . '<br />';
echo 'readable: ' . is_readable(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php') . '<br />';
echo 'executable: ' . is_executable(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php') . '<br />';

echo 'test de inclusion: ';
echo '[' . file_get_contents(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php') . ']';

echo 'test require';
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
