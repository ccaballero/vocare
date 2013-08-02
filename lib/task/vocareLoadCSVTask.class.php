<?php

class vocareLoadCSVTask extends sfBaseTask
{
    protected function configure() {
        $this->addArguments(array(
            // csv file must be a absolute path, always forever and ever
            new sfCommandArgument('csv_file',
                sfCommandArgument::REQUIRED,
                'The CSV file for parsing'),
            new sfCommandArgument('type',
                sfCommandArgument::REQUIRED,
                'If the file is registration, reception, or habilitation'),
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
        $type = $arguments['type'];

        if (!file_exists($csv)) {
            $this->logSection('vocare', sprintf('File "%s" not found', $csv));
            return;
        }

        switch($type) {
            case 'registration':
                $this->parseRegistration($csv);
                break;
            case 'reception':
                $this->parseReception($csv);
                break;
            case 'habilitation':
                $this->parseHabilitation($csv);
                break;
        }

        $this->logSection('vocare', sprintf('Create user "%s"', $arguments['username']));
    }

    private function parseRegistration($csv) {
        $fd = fopen($csv, 'r');

        // header of csv
        fgetcsv($fd, 0, "\t");

        echo '>>  convocatorias cargando información de registro .... ';

        // content of csv
        while (($csv = fgetcsv($fd, 0, ",")) !== false) {
            // get the data
            $last_name = $csv[0];
            $first_name = $csv[1];
            $email_address = $csv[2];
            $translit = explode(' ', iconv('UTF-8', 'ASCII//TRANSLIT', $last_name));
            $username = substr(strtolower($first_name), 0, 1) . strtolower($translit[0]);
            $password = 'asdf';

            $user = new sfGuardUser();
            $user->setEmailAddress($email_address);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $user->setIsActive(true);
            $user->setIsSuperAdmin(false);
            $user->save();
        }
        
        fclose($fd);
    }

    private function parseReception() {}
    private function parseHabilitation() {}
}
