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

        $type = strtolower($matches['type']);
        switch($type) {
            case 'postulantes':
                $this->logSection('vocare',
                    'Registrando postulantes para una convocatoria');
                $this->parseRegistration($csv, $convocatoria);
                break;
            case 'recepcion':
                $this->logSection('vocare',
                    'Registrando un conjunto de recepciones');
                $this->parseReception($csv, $convocatoria);
                break;
            case 'habilitacion':
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

    private function getPostulante($convocatoria, $headers, $row) {
        $ap = array_search('APELLIDO_PATERNO', $headers);
        $am = array_search('APELLIDO_MATERNO', $headers);
        $n = array_search('NOMBRES', $headers);

        if ($ap !== false && $am !== false && $n !== false) {
            $postulante = Doctrine::getTable('Postulante')
                        ->findByConvocatoriaAndPostulante($convocatoria,
                            $row[$ap], $row[$am], $row[$n]);

            if (!empty($postulante)) {
                return $postulante;
            }
        }

        $postulante = new Postulante();
        $postulante->Convocatoria = $convocatoria;
        return $postulante;
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
        echo 'TELEFONO' . PHP_EOL;

        // content of csv
        while (($csv = fgetcsv($fd, 0, ",")) !== false) {
            $postulante = $this->getPostulante($convocatoria, $headers, $csv);
            $postulante->clearRequerimientos();

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
                        }
                    }
                }
            }

            $postulante->estado = 'pendiente';
            $postulante->save();

            echo str_pad($postulante->getApellidoPaterno(), 16)
               . str_pad($postulante->getApellidoMaterno(), 16)
               . str_pad($postulante->getNombres(), 20)
               . str_pad($postulante->getCi(), 13)
               . str_pad($postulante->getSis(), 10)
               . str_pad($postulante->getCorreoElectronico(), 45)
               . str_pad($postulante->getTelefono(), 2)
               . str_pad($postulante->getDireccion(), 2)
               . PHP_EOL;
        }

        fclose($fd);
    }

    private function parseReception($csv, $convocatoria) {
        $fd = fopen($csv, 'r');

        // header of csv
        $headers = fgetcsv($fd, 0, ",");

        echo '>>  convocatorias cargando información de recepción .... '
            . PHP_EOL;
        echo 'APE_PATERNO     ';
        echo 'APE_MATERNO     ';
        echo 'NOMBRES             ';
        echo 'FECHA_ENTREGA            ';
        echo 'NUMERO_HOJAS' . PHP_EOL;

        // content of csv
        while (($csv = fgetcsv($fd, 0, ",")) !== false) {
            $postulante = $this->getPostulante($convocatoria, $headers, $csv);

            for ($i = 0; $i < count($headers); $i++) {
                $parameter = strtolower($headers[$i]);
                try {
                    $postulante->$parameter = trim($csv[$i]);
                } catch (Exception $e) {}
            }

            $postulante->estado = 'inscrito';
            $postulante->save();

            echo str_pad($postulante->getApellidoPaterno(), 16)
               . str_pad($postulante->getApellidoMaterno(), 16)
               . str_pad($postulante->getNombres(), 20)
               . str_pad($postulante->getFechaEntrega(), 25)
               . str_pad($postulante->getNumeroHojas(), 12)
               . PHP_EOL;
        }

        fclose($fd);
    }

    private function parseHabilitation($csv, $convocatoria) {
        $fd = fopen($csv, 'r');

        // header of csv
        $headers = fgetcsv($fd, 0, ",");

        echo '>>  convocatorias cargando información de habilitación .... '
            . PHP_EOL;
        echo 'APE_PATERNO     ';
        echo 'APE_MATERNO     ';
        echo 'NOMBRES             ';
        echo 'OBSERVACIONES            ' . PHP_EOL;

        // content of csv
        while (($csv = fgetcsv($fd, 0, ",")) !== false) {
            $postulante = $this->getPostulante($convocatoria, $headers, $csv);
            $postulante->clearRequisitos();
            $postulante->clearDocumentos();

            $list = array();
            $count = 0;

            $requisitos = Doctrine::getTable('Requisito')
                        ->getRequisitos($convocatoria);
            $documentos = Doctrine::getTable('Documento')
                        ->getDocumentos($convocatoria);

            foreach ($requisitos as $requisito) {
                $list[chr($count + 97)] = array('requisito', $requisito);
                $count++;
            }
            foreach ($documentos as $documento) {
                $list[chr($count + 97)] = array('documento', $documento);
                $count++;
            }

            for ($i = 0; $i < count($headers); $i++) {
                $parameter = strtolower($headers[$i]);
                try {
                    $postulante->$parameter = trim($csv[$i]);
                } catch (Exception $e) {
                    if (!empty($csv[$i])) {
                        $parameter = strtolower($parameter);
                        $row = $list[$parameter];

                        switch ($row[0]) {
                            case 'requisito':
                                $postulante->PostulanteRequisitos[]
                                           ->Requisito = $row[1];
                                break;
                            case 'documento':
                                $postulante->PostulanteDocumentos[]
                                           ->Documento = $row[1];
                                break;
                        }
                    }
                }
            }

            $postulante->save();

            echo str_pad($postulante->getApellidoPaterno(), 16)
               . str_pad($postulante->getApellidoMaterno(), 16)
               . str_pad($postulante->getNombres(), 20)
               . str_pad($postulante->getObservacion(), 25)
               . PHP_EOL;
        }

        fclose($fd);
    }
}
