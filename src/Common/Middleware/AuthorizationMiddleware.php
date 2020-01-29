<?php

declare(strict_types=1);

namespace Event\Common\Middleware;

use Common\Entity\DataObject;
use Event\Common\Container\Identity;
use Event\Common\Container\Jwt;
use Event\Common\Exception\InvalidTokenException;
use Lcobucci\JWT\ValidationData;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthorizationMiddleware implements MiddlewareInterface
{
    /**
     * @var Jwt
     */
    protected $token;

    /**
     * AuthorizationMiddleware constructor.
     * @param Jwt $token
     */
    public function __construct(Jwt $token)
    {
        $this->token = $token;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $authorization = $request->getHeader('Authorization');
        $identity = new Identity();

        /* get JWT from headers */
        try {
            if (isset($authorization[0]) && substr($authorization[0], 0, 6) == 'Bearer') {
                /* get JWT */
                $tokenString = substr($authorization[0], 7);
                /* validate&parse JWT */
                $token = $this->token->parse($tokenString, $this->getValidationValues());

                /* create authentication's DO */
                $identity = $identity
                    ->setTokenIdentifier($token->getClaim('jti'))
                    ->setUserId($token->getClaim('uid'))
                    ->setRole($token->getClaim('role'));
                $request = $request->withAttribute(Identity::class, $identity);
            } else {
                throw InvalidTokenException::notExistHeader();
            }
        } catch (\RuntimeException $err) {
            throw InvalidTokenException::unknown($err->getMessage());
        }
        return $handler->handle($request);
    }

    protected function getValidationValues(): ?ValidationData
    {
        return null;
    }
}