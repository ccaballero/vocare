<?php

class vocareCrontabTask extends sfBaseTask
{
    protected function configure() {
        $this->addOptions(array(
            new sfCommandOption('application', null,
                sfCommandOption::PARAMETER_OPTIONAL,
                    'The application name', null),
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
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $debug = $options['debug'];

        echo date('Y-m-d H:i:s') . PHP_EOL;

        $timeI = intval(date('H') . '00');
        $interval = 100;

        $filler1 = str_repeat(' ', 14);
        $triggered_tasks = '';

        // Fetch the events in today
        $events = Doctrine::getTable('ConvocatoriaEvento')
                ->selectByDate(date('Y-m-d'));
        if (count($events) <> 0) {
            foreach ($events as $event) {
                if ($debug) { echo 'Evento: ' . $event . PHP_EOL; }

                $tasks = $event->getTasks();
                if (count($tasks) <> 0) {
                    $_tasks = explode('::', $tasks);
                    foreach ($_tasks as $_task) {
                        if ($debug) { echo '    Tarea: ' . $_task . PHP_EOL; }

                        preg_match('/\[(?P<time>.*)\](?P<task>.*)/',
                            $_task, $matches);

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
                                    . $method . PHP_EOL;
                            }

                            $event->$method();
                            $triggered_tasks .= $event . PHP_EOL
                                              . $filler1 . $trigger . PHP_EOL;
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
