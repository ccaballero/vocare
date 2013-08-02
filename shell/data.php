<?php

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

$database_yml = sfYaml::load(dirname(__FILE__) . '/../config/databases.yml');
$pdo_connection = $database_yml['all']['doctrine']['param'];

/* PDO connection */
$dsn = $pdo_connection['dsn'];
$user = $pdo_connection['username'];
$password = $pdo_connection['password'];
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$dbh = new PDO($dsn, $user, $password, $options);

/* Doctrine configuration */
$configuration = ProjectConfiguration::getApplicationConfiguration('convocatorias', 'prod', false);
sfCoreAutoload::register();

require_once('/opt/symfony/lib/plugins/sfDoctrinePlugin/lib/vendor/doctrine/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));

$manager = Doctrine_Manager::getInstance();
$manager->openConnection($dbh);

$bldgrn = "\033[1;32m"; // Green
$txtwht = "\033[0;37m"; // White

$csv_dir = dirname(__FILE__) . '/../data/csv';
$csv_file = '/2_reception.csv';
$fd = fopen($csv_dir . $csv_file, 'r');

// header of csv
fgetcsv($fd, 0, "\t");

echo '>> ' . $bldgrn . 'convocatorias' . $txtwht . '  cargando información de recepción .... ';

// content of csv
while (($csv = fgetcsv($fd, 0, "\t")) !== FALSE) {
    // get the data
    $last_name = $csv[0];
    $first_name = $csv[1];
    $translit = explode(' ', iconv('UTF-8', 'ASCII//TRANSLIT', $last_name));
    $username = substr(strtolower($first_name), 0, 1) . strtolower($translit[0]);
    $email_address = $username . '@localhost';
    
    $user = new sfGuardUser();
    $user->setEmailAddress($email_address);
    $user->setUsername($username);
    $user->setPassword($password);
    $user->setFirstName($first_name);
    $user->setLastName($last_name);
    $user->setIsActive(true);
    $user->setIsSuperAdmin(false);
    $user->save();

//    $fecha_entrega = $csv[2];
//    $numero_hojas = $csv[3];
//
//    $user_id = mysql_insert_id();
//
//    $sql2 = sprintf(
//        'INSERT INTO `postulante` (`user_id`, `fecha_entrega`, `numero_hojas`) VALUES (%d, \'%s\', \'%s\');',
//        $user_id,
//        mysql_real_escape_string($fecha_entrega),
//        mysql_real_escape_string($numero_hojas)
//    );
//
//    $result = mysql_query($sql2);
//
//    $telefonos = $csv[4];
//
//    $sql3 = sprintf(
//        'INSERT INTO `perfil` (`user_id`, `telefonos`) VALUES (%d, \'%s\');',
//        $user_id,
//        mysql_real_escape_string($telefonos)
//    );
//
//    $result = mysql_query($sql3);
//
//    // convocatoria
//    $convocatoria_id = 2;
//    // requerimientos
//    $requerimientos = array(
//        1 => $csv[5],
//        2 => $csv[6],
//        3 => $csv[7],
//        4 => $csv[8],
//        5 => $csv[9],
//        6 => $csv[10],
//        7 => $csv[11],
//    );
//
//    foreach ($requerimientos as $requerimiento_id => $flag) {
//        if (!empty($flag)) {
//            $sql4 = sprintf(
//                'INSERT INTO `convocatoria_requerimiento_usuario` (`convocatoria_id`, `requerimiento_id`, `user_id`) VALUES (%d, %d, %d);',
//                $convocatoria_id, $requerimiento_id, $user_id
//            );
//
//            $result = mysql_query($sql4);
//        }
//    }
}

fclose($fd);

echo $bldgrn . '[OK]' . $txtwht . PHP_EOL;

//$query = sprintf(
// 'SELECT ident, username, password FROM user WHERE username=\'%s\' AND lastname=\'%s\'',
// mysql_real_escape_string($firstname),
// mysql_real_escape_string($lastname));



