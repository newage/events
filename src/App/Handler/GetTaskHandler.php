<?php

declare(strict_types=1);

namespace Event\App\Handler;

use Event\App\Mapper\TaskMapperInterface;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetTaskHandler implements RequestHandlerInterface
{
    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;
    /**
     * @var HalResponseFactory
     */
    private $responseFactory;

    /** @var TaskMapperInterface */
    private $mapper;

    public function __construct(
        TaskMapperInterface $mapper,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory
    ) {
        $this->mapper = $mapper;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $id = $request->getAttribute('id', false);
        $task = $this->mapper->fetch($id);

        $resource = $this->resourceGenerator->fromObject($task, $request);
        return $this->responseFactory->createResponse($request, $resource);
    }
}