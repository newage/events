<?php

declare(strict_types=1);

namespace Event\App\Factory;

use Event\App\Handler\GetTaskHandler;
use Event\App\Mapper\TaskMapperInterface;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Container\ContainerInterface;

class GetTaskHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetTaskHandler
    {
        $mapper = $container->get(TaskMapperInterface::class);
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);
        return new GetTaskHandler($mapper, $resourceGenerator, $responseFactory);
    }
}