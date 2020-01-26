<?php

declare(strict_types=1);

namespace Event\App\Handler;

use Event\Common\Container\Identity;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PostTaskHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $identity = $request->getAttribute(Identity::class);
        var_dump($body, $identity);
    }

}