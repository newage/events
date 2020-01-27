<?php

use Mezzio\Hal\Metadata\MetadataMap;
use Mezzio\Hal\Metadata\RouteBasedCollectionMetadata;
use Mezzio\Hal\Metadata\RouteBasedResourceMetadata;
use Laminas\Hydrator\ClassMethodsHydrator;
use Event\App\Entity;

return [
    MetadataMap::class => [
        [
            '__class__' => RouteBasedResourceMetadata::class,
            'resource_class' => Entity\Task::class,
            'route' => 'get.task',
            'extractor' => ClassMethodsHydrator::class,
        ],
        [
            '__class__' => RouteBasedCollectionMetadata::class,
            'collection_class' =>Entity\TaskCollection::class,
            'collection_relation' => 'get.tasks',
            'route' => 'tasks',
        ],
    ],
];