<?php

declare(strict_types=1);

namespace Event\Common\Factory;

use Event\Common\Container\Jwt;
use Event\Common\Middleware\AuthorizationMiddleware;
use Psr\Container\ContainerInterface;

class AuthorizationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $token = new Jwt();
        return new AuthorizationMiddleware($token);
    }
}