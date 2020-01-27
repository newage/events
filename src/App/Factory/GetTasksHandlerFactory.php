<?php

declare(strict_types=1);

namespace Event\App\Factory;

use Event\App\Handler\GetTasksHandler;
use Event\App\Mapper\TaskMapperInterface;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class GetTasksHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetTasksHandler
    {
        $mapper = $container->get(TaskMapperInterface::class);
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);
        return new GetTasksHandler($mapper, $resourceGenerator, $responseFactory);
    }
}