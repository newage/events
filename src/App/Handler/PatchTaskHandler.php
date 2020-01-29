<?php

declare(strict_types=1);

namespace Event\App\Handler;

use Event\App\Entity\Task;
use Event\App\Exception\TaskException;
use Event\App\Mapper\TaskMapperInterface;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\InputFilter\InputFilter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PatchTaskHandler implements RequestHandlerInterface
{
    /**
     * @var TaskMapperInterface
     */
    protected $mapper;

    /**
     * PostTaskHandler constructor.
     * @param TaskMapperInterface           $mapper
     */
    public function __construct(TaskMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int) $request->getAttribute('id');
        $body = $request->getParsedBody();

        $inputFilter = new InputFilter();
        $inputFilter->add(Task::validationName());
        $inputFilter->add(Task::validationDescription());
        $inputFilter->setData($body);

        if (! $inputFilter->isValid()) {
            throw TaskException::validation($inputFilter->getMessages());
        }

        try {
            $entity = (new Task)
                ->setName($body['name'])
                ->setDescription($body['description']);
            $this->mapper->update($entity, $id);
        } catch (\PDOException $err) {
            throw TaskException::storageError($err->getMessage());
        }

        return new EmptyResponse();
    }
}