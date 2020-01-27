<?php

namespace Event\App\Mapper;

use Event\App\Entity\Task;
use Event\App\Entity\TaskCollection;
use Event\Common\Exception\NotFoundException;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Paginator\Adapter\ArrayAdapter;

interface TaskMapperInterface extends MapperInterface
{

    public function create(Task $entity): ?Task;

    public function fetch($id): ?Task;

    public function fetchAll(): TaskCollection;
}