<?php

declare(strict_types=1);

namespace Event\App\Factory;

use Event\App\Mapper\PdoTasksMapper;
use Event\Common\Container\ConfigInterface;
use Psr\Container\ContainerInterface;

class PdoTasksMapperFactory
{
    public function __invoke(ContainerInterface $container): PdoTasksMapper
    {
        $config = $container->get(ConfigInterface::class);
        $params = $config->get('pdo.mysql');
        $pdo = new \PDO(
            'mysql:host='.$params['host'].';port='.$params['port'].';dbname='.$params['database'].';charset=utf8',
            $params['user'],
            $params['pass'],
            !empty($params['options']) ? $params['options'] : null
        );
        return new PdoTasksMapper($pdo);
    }
}