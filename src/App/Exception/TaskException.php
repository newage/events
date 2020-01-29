<?php

declare(strict_types=1);

namespace Event\App\Exception;

use Fig\Http\Message\StatusCodeInterface;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

class TaskException extends \RuntimeException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;

    const STATUS = 400;
    const TYPE = 'problems/task';

    public static function validation(array $messages) : self
    {
        $e = new self();
        $e->status = self::STATUS;
        $e->type   = self::TYPE;
        $e->title  = 'Validation error';
        $e->detail = 'Sent data are not valid';
        $e->additional = [
            'errors' => $messages,
        ];

        return $e;
    }

    public static function storageError($message) : self
    {
        $e = new self();
        $e->status = StatusCodeInterface::STATUS_CONFLICT  ;
        $e->type   = self::TYPE;
        $e->title  = 'Storage error';
        $e->detail = $message;
        $e->additional = [];

        return $e;
    }
}