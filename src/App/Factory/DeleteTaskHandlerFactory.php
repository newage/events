<?php

declare(strict_types=1);

namespace Event\App\Factory;

use Event\App\Handler\DeleteTaskHandler;
use Event\App\Mapper\TaskMapperInterface;
use Psr\Container\ContainerInterface;

class DeleteTaskHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeleteTaskHandler
    {
        $mapper = $container->get(TaskMapperInterface::class);
        return new DeleteTaskHandler($mapper);
    }
}