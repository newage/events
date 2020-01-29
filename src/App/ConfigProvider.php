<?php

declare(strict_types=1);

namespace Event\App;

/**
 * The configuration provider for the App module
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                Mapper\TaskMapperInterface::class => Factory\PdoTasksMapperFactory::class,
                Handler\PostTaskHandler::class => Factory\PostTaskHandlerFactory::class,
                Handler\PatchTaskHandler::class => Factory\PatchTaskHandlerFactory::class,
                Handler\GetTaskHandler::class => Factory\GetTaskHandlerFactory::class,
                Handler\GetTasksHandler::class => Factory\GetTasksHandlerFactory::class,
                Handler\DeleteTaskHandler::class => Factory\DeleteTaskHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
