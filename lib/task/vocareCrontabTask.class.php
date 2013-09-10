<?php

class vocareCrontabTask extends sfBaseTask
{
    protected function configure() {
        $this->addArguments(array(
            new sfCommandArgument('interval',
                sfCommandArgument::OPTIONAL,
                'The interval of time between triggers', 100),
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null,
                sfCommandOption::PARAMETER_REQUIRED,
                    'The application name', 'convocatorias'),
            new sfCommandOption('env', null,
                sfCommandOption::PARAMETER_REQUIRED,
                    'The environment', 'dev'),
            new sfCommandOption('debug', null,
                sfCommandOption::PARAMETER_NONE,
                    'If you wish more details'),
        ));

        $this->namespace        = 'vocare';
        $this->name             = 'crontab';
        $this->briefDescription = 'Scheduler for automatic tasks in vocare';
        $this->detailedDescription = <<<EOF
The [vocare:crontab|INFO] task does things.
Call it with:

[php symfony vocare:crontab|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        // Viewers loading
        sfContext::createInstance($this->configuration);
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);

        $debug = $options['debug'];

        $interval = intval($arguments['interval']);

        $timeI = intval(date('Hi'));

        echo date('Y-m-d H:i:s') . ' ' . str_repeat('-', 10). '> ' . $timeI
            . '{' . $interval . '}' . PHP_EOL;

        // Fetch the events in today
        $events = Doctrine::getTable('ConvocatoriaEvento')
                ->selectByDate(date('Y-m-d'));
        if (count($events) <> 0) {
            $task_manager = VocareTask::getInstance();

            foreach ($events as $event) {
                if ($debug) { echo 'Evento: ' . $event . PHP_EOL; }

                $tasks = $event->getTasks();
                if (count($tasks) <> 0) {
                    $_tasks = explode('::', $tasks);
                    foreach ($_tasks as $_task) {
                        if ($debug) { echo '    Tarea: ' . $_task . PHP_EOL; }

                        preg_match('/\[(?P<time>.*)\](?P<task>.*)/',
                            $_task, $matches);

                        if (isset($matches['time'])
                                && isset($matches['task'])) {
                            $_time = $matches['time'];
                            $trigger = $matches['task'];

                            if ($timeI <= $_time && $_time < ($timeI + $interval)) {
                                $parts = explode('-', $trigger);
                                foreach ($parts as $key => $part) {
                                    $parts[$key] = ucfirst($part);
                                }
                                $method = 'trigger' . implode('', $parts);

                                if ($debug) {
                                    echo '    Invocando el metodo '
                                        . $method;
                                }

                                $return = $task_manager
                                        ->$method($event->getConvocatoria());

                                if ($debug) {
                                    echo ' => ' . $return . PHP_EOL;
                                }
                            }
                        }
                    }
                } else if ($debug) {
                    echo 'Evento: ' . $event . ' no tiene tareas el dia de hoy';
                }
            }
        } else if ($debug) {
            echo 'No existen eventos el dia de hoy' . PHP_EOL;
        }
    }
}
