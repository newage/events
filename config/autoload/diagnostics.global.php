<?php

use Laminas\Diagnostics\Check\Redis;

return [
    'diagnostics' => [
        'redis' => new Redis(getenv('REDIS_HOST'), getenv('REDIS_PORT'), getenv('REDIS_AUTH')),
    ]
];