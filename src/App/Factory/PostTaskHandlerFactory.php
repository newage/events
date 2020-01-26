<?php

declare(strict_types=1);

namespace Event\App\Factory;

use Event\App\Handler\PostTaskHandler;
use Event\App\Mapper\TaskMapperInterface;
use Psr\Container\ContainerInterface;

class PostTaskHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostTaskHandler
    {
        $mapper = $container->get(TaskMapperInterface::class);
        return new PostTaskHandler($mapper);
    }
}