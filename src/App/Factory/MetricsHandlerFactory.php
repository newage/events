<?php

declare(strict_types=1);

namespace Event\App\Factory;

use Event\Common\Container\ConfigInterface;
use Interop\Container\ContainerInterface;
use Event\App\Handler\MetricsHandler;

class MetricsHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class);
        $collection = new \SplObjectStorage();
        foreach ($config->get('diagnostics') as $checkerName => $checkerClass) {
            if (is_object($checkerClass)) {
                $collection->attach($checkerClass, $checkerName);
            } else {
                $collection->attach(new $checkerClass($container), $checkerName);
            }
        }
        return new MetricsHandler($collection);
    }
}