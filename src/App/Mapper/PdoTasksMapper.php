<?php

declare(strict_types=1);

namespace Event\App\Mapper;

use Event\App\Entity\Task;
use Event\App\Entity\TaskCollection;
use Event\Common\Exception\NotFoundException;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Paginator\Adapter\ArrayAdapter;

class PdoTasksMapper implements TaskMapperInterface
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * PdoMysqlMapper constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetch(int $id): ?Task
    {
        $hydrator = new ClassMethodsHydrator();

        $statement = $this->pdo->prepare('SELECT * FROM tasks WHERE id = :id');
        if (!$statement->execute([':id' => $id])) {
            return null;
        }

        $post = $statement->fetch(\PDO::FETCH_ASSOC);
        return $post ? $hydrator->hydrate((array) $post, new Task()) : null;
    }

    public function fetchAll(): TaskCollection
    {
        $hydrator = new ClassMethodsHydrator();
        $statement = $this->pdo->prepare('SELECT * FROM tasks');
        if (!$statement->execute()) {
            throw new NotFoundException('Wrong execution!');
        }

        $posts = [];
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $posts[] = $hydrator->hydrate((array) $row, new Task());
        }
        return new TaskCollection(new ArrayAdapter($posts));
    }

    public function create(Task $entity): ?Task
    {
        $statement = $this->pdo->prepare('INSERT `tasks` (name,description) VALUES(:name,:description)');
        $statement->bindParam('name', $entity->getName());
        $statement->bindParam('description', $entity->getDescription());
        if (!$statement->execute()) {
            return null;
        }
        $entity = $entity->setId($this->pdo->lastInsertId());
        return $entity;
    }

    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare('DELETE FROM `tasks` WHERE id = :id');
        if (!$statement->execute([':id' => $id])) {
            return false;
        }
        return true;
    }
}