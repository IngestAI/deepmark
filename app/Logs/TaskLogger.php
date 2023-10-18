<?php

namespace App\Logs;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class TaskLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $handler = new StreamHandler($config['path'] ?? '');

        $formatter = new LineFormatter(
            '[%datetime%] %channel%.%level_name%: %message%' . "\n",
            'Y-m-d H:i:s e',
            true,
            true,
            true
        );
        $handler->setFormatter($formatter);

        return new Logger('logger', [$handler]);
    }
}
