<?php

declare(strict_types=1);

namespace Event\Common\Exception;

use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

class InvalidTokenException extends \RuntimeException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;

    const STATUS = 401;
    const TYPE = 'problems/authorization';

    public static function notParsed(): self
    {
        $e = new self();
        $e->status = self::STATUS;
        $e->type   = self::TYPE;
        $e->title  = 'JWT can not be parsed';
        $e->detail = 'More information in a jwt specification on https://jwt.io';
        $e->additional = [];

        return $e;
    }

    public static function notValid(): self
    {
        $e = new self();
        $e->status = self::STATUS;
        $e->type   = self::TYPE;
        $e->title  = 'JWT is not valid';
        $e->detail = 'More information in a jwt specification on https://jwt.io';
        $e->additional = [];

        return $e;
    }

    public static function notVerified(): self
    {
        $e = new self();
        $e->status = self::STATUS;
        $e->type   = self::TYPE;
        $e->title  = 'JWT signature is no valid';
        $e->detail = 'JWT can not be decoded.';
        $e->additional = [];

        return $e;
    }

    public static function unknown($message): self
    {
        $e = new self();
        $e->status = self::STATUS;
        $e->type   = self::TYPE;
        $e->title  = 'Unknown authorization exception';
        $e->detail = $message;
        $e->additional = [];

        return $e;
    }

    public static function notExistHeader(): self
    {
        $e = new self();
        $e->status = self::STATUS;
        $e->type   = self::TYPE;
        $e->title  = 'Token in headers is not valid';
        $e->detail = 'More information in a jwt specification on https://jwt.io';
        $e->additional = [];

        return $e;
    }
}