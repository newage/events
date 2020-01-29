<?php

namespace Event\App\Mapper;

use Event\App\Entity\Task;
use Event\App\Entity\TaskCollection;
use Event\Common\Exception\NotFoundException;

interface TaskMapperInterface extends MapperInterface
{

    public function create(Task $entity): ?Task;

    public function fetch(int $id): ?Task;

    public function fetchAll(): TaskCollection;

    public function delete(int $id): bool;
}