<?php

class vocareLoadCSVTask extends sfBaseTask
{
    protected function configure() {
        $this->addArguments(array(
            // csv file must be a absolute path, always forever and ever
            new sfCommandArgument('csv_file',
                sfCommandArgument::REQUIRED,
                'The CSV file for parsing'),
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null,
                sfCommandOption::PARAMETER_OPTIONAL,
                    'The application name', null),
            new sfCommandOption('env', null,
                sfCommandOption::PARAMETER_REQUIRED,
                    'The environment', 'dev'),
        ));

        $this->namespace        = 'vocare';
        $this->name             = 'loadCSV';
        $this->briefDescription = 'Import of CSV file for document reception';
        $this->detailedDescription = <<<EOF
The [vocare:loadCSV|INFO] task does things.
Call it with:

[php symfony vocare:loadCSV|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);

        $csv = $arguments['csv_file'];

        if (!file_exists($csv)) {
            $this->logSection('vocare', sprintf('File "%s" not found', $csv));
            return;
        }

        $matches = array();
        preg_match(
            '/(?P<convocatoria>\d+)_(?P<type>\w+).csv/',
            basename($csv), $matches);

        if (!isset($matches['convocatoria']) ||
            !isset($matches['type'])) {
            $this->logSection(
                'vocare', 'El archivo no posee el estandar adecuado');
            return;
        }

        $id_convocatoria = intval($matches['convocatoria']);
        $convocatoria =
            Doctrine::getTable('Convocatoria')->find($id_convocatoria);

        if (empty($convocatoria)) {
            $this->logSection(
                'vocare', 'La convocatoria no existe');
            return;
        }

        $type = intval($matches['type']);
        switch($type) {
            case 'postulantes':
                $this->parseRegistration($csv, $convocatoria);
                break;
            case 'reception':
                $this->parseReception($csv, $convocatoria);
                break;
            case 'habilitation':
                $this->parseHabilitation($csv, $convocatoria);
                break;
        }
    }

    private function parseRegistration($csv, $convocatoria) {
        $fd = fopen($csv, 'r');

        // header of csv
        $headers = fgetcsv($fd, 0, ",");
        var_dump($headers);

        echo '>>  convocatorias cargando información de registro .... ' . PHP_EOL;
        echo 'APE_PATERNO     ';
        echo 'APE_MATERNO     ';
        echo 'NOMBRES             ';
        echo 'CI           ';
        echo 'SIS       ';
        echo 'EMAIL                                        ';
        echo '1 2 3 4 5 6 7' . PHP_EOL;

        // content of csv
        while (($csv = fgetcsv($fd, 0, ",")) !== false) {
            // get the data
            echo str_pad($csv[ 0], 16);
            echo str_pad($csv[ 1], 16);
            echo str_pad($csv[ 2], 20);
            echo str_pad($csv[ 3], 13);
            echo str_pad($csv[ 4], 10);
            echo str_pad($csv[ 5], 45);
            echo str_pad($csv[ 8], 2);
            echo str_pad($csv[ 9], 2);
            echo str_pad($csv[10], 2);
            echo str_pad($csv[11], 2);
            echo str_pad($csv[12], 2);
            echo str_pad($csv[13], 2);
            echo str_pad($csv[14], 2);
            echo PHP_EOL;

            $postulante = new Postulante();

            $postulante->Convocatoria = $convocatoria;
            $postulante->apellido_paterno = trim($csv[0]);
            $postulante->apellido_materno = trim($csv[1]);
            $postulante->nombres = trim($csv[2]);
            $postulante->ci = trim($csv[3]);
            $postulante->sis = trim($csv[4]);
            $postulante->correo_electronico = trim($csv[5]);
            $postulante->telefono = trim($csv[6]);
            $postulante->direccion = trim($csv[7]);
            $postulante->save();
        }

        fclose($fd);
    }

    private function parseReception($csv, $convocatoria) {}
    private function parseHabilitation($csv, $convocatoria) {}
}
