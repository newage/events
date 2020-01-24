<?php

namespace Common\Factory;

use Common\Container\Config;
use Psr\Container\ContainerInterface;

class ConfigFactory
{
    /**
     * @param ContainerInterface $container
     * @return Config
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        return new Config($config);
    }
}