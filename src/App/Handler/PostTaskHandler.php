<?php

declare(strict_types=1);

namespace Event\App\Handler;

use Event\App\Entity\Task;
use Event\App\Mapper\TaskMapperInterface;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PostTaskHandler implements RequestHandlerInterface
{
    /**
     * @var TaskMapperInterface
     */
    protected $mapper;

    /**
     * PostTaskHandler constructor.
     * @param TaskMapperInterface $mapper
     */
    public function __construct(TaskMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
//        $identity = $request->getAttribute(Identity::class);
        $entity = (new Task)
            ->setName($body['name'])
            ->setDescription($body['description']);
        $this->mapper->create($entity);
        return new EmptyResponse();
    }

}