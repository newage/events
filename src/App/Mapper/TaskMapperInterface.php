<?php

namespace Event\App\Mapper;

use Event\App\Entity\Task;

interface TaskMapperInterface extends MapperInterface
{

    public function create(Task $entity): ?Task;

    public function fetch($id): ?Task;
}