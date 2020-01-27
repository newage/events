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

    public function fetch($id): ?Task
    {
        $hydrator = new ClassMethodsHydrator();

        $select = $this->pdo->prepare('SELECT * from tasks WHERE id = :id');
        if (!$select->execute([':id' => $id])) {
            return null;
        }

        $post = $select->fetch(\PDO::FETCH_ASSOC);
        return $post ? $hydrator->hydrate((array) $post, new Task()) : null;
    }

    public function fetchAll(): TaskCollection
    {
        $hydrator = new ClassMethodsHydrator();
        $select = $this->pdo->prepare('SELECT * from tasks');
        if (!$select->execute()) {
            throw new NotFoundException('Wrong execution!');
        }

        $posts = [];
        foreach ($select->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $posts[] = $hydrator->hydrate((array) $row, new Task());
        }
        $collection = new TaskCollection(new ArrayAdapter($posts));
        return $collection;
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
}