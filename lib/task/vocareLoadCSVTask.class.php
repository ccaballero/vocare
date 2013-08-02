<?php

class vocareLoadCSVTask extends sfBaseTask
{
    protected function configure() {
        $this->addArguments(array(
            new sfCommandArgument('csv_file', sfCommandArgument::REQUIRED, 'The CSV file for parsing'),
            new sfCommandArgument('type', sfCommandArgument::REQUIRED, 'If the file is registration, reception, or habilitation'),
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', null),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
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

    private function parseRegistration() {

    }

    private function parseReception() {}
    private function parseHabilitation() {}
}
