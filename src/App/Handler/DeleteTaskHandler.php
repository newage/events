<?php

declare(strict_types=1);

namespace Event\App\Handler;

use Event\App\Exception\TaskException;
use Event\App\Mapper\TaskMapperInterface;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteTaskHandler implements RequestHandlerInterface
{
    /** @var TaskMapperInterface */
    private $mapper;

    public function __construct(TaskMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $id = (int) $request->getAttribute('id');

        try {
            if (!$this->mapper->delete($id)) {
                throw TaskException::notDelete();
            }
        } catch (\PDOException $err) {
            throw TaskException::notDelete();
        }

        return new EmptyResponse();
    }
}