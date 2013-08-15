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
                $this->logSection('vocare',
                    'Registrando postulantes para una convocatoria');
                $this->parseRegistration($csv, $convocatoria);
                break;
            case 'reception':
                $this->logSection('vocare',
                    'Registrando un conjunto de recepciones');
                $this->parseReception($csv, $convocatoria);
                break;
            case 'habilitation':
                $this->logSection('vocare',
                    'Registrando un conjunto de habilitaciones');
                $this->parseHabilitation($csv, $convocatoria);
                break;
            default:
                $this->logSection('vocare',
                    'Haciendo absolutamente nada!');
                break;
        }
    }

    private function parseRegistration($csv, $convocatoria) {
        $fd = fopen($csv, 'r');

        // header of csv
        $headers = fgetcsv($fd, 0, ",");

        echo '>>  convocatorias cargando información de registro .... '
            . PHP_EOL;
        echo 'APE_PATERNO     ';
        echo 'APE_MATERNO     ';
        echo 'NOMBRES             ';
        echo 'CI           ';
        echo 'SIS       ';
        echo 'EMAIL                                        ';
//        echo '1 2 3 4 5 6 7' . PHP_EOL;

        // content of csv
        while (($csv = fgetcsv($fd, 0, ",")) !== false) {
            $postulante = new Postulante();
            $postulante->Convocatoria = $convocatoria;

            for ($i = 0; $i < count($headers); $i++) {
                $parameter = strtolower($headers[$i]);
                try {
                    $postulante->$parameter = trim($csv[$i]);
                } catch (Exception $e) {
                    if (!empty($csv[$i])) {
                        $parameter = strtoupper($parameter);
                        $requerimiento = Doctrine::getTable('Requerimiento')
                            ->findByCodigo($parameter);

                        if (!empty($requerimiento)) {
                            $postulante->PostulanteRequerimientos[]->Requerimiento = $requerimiento;
//                            $postulante_req = new PostulanteRequerimiento();
//                            $postulante_req->Requerimiento = $requerimiento;
//                            $postulante_req->Postulante = $postulante;
//                            $postulante_req->save();
                        }
                    }
                }
            }

            $postulante->save();
            echo $postulante . PHP_EOL;
        }

        fclose($fd);
    }

    private function parseReception($csv, $convocatoria) {}
    private function parseHabilitation($csv, $convocatoria) {}
}
