<?php

declare(strict_types=1);

namespace Event\App\Factory;

use Event\App\Handler\PatchTaskHandler;
use Event\App\Mapper\TaskMapperInterface;
use Psr\Container\ContainerInterface;

class PatchTaskHandlerFactory
{
    public function __invoke(ContainerInterface $container): PatchTaskHandler
    {
        return new PatchTaskHandler($container->get(TaskMapperInterface::class));
    }
}