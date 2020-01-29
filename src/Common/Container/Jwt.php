<?php

declare(strict_types=1);

namespace Event\Common\Container;

use Event\Common\Exception\InvalidTokenException;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;

/**
 * Class Jwt
 * @package Common\Api\Container
 */
class Jwt implements JwtReaderInterface
{
    /**
     * Verify token
     * @param Token $token
     * @return bool
     */
    protected function verify(Token $token)
    {
        $signer = new Sha256();
        return $token->verify($signer, new Key(file_get_contents($this->getPublicKeyPath())));
    }

    /**
     * Validate token
     * @param Token          $token
     * @param ValidationData $data
     * @return bool
     */
    protected function validate(Token $token, ValidationData $data)
    {
        return $token->validate($data);
    }

    /**
     * Parse token
     * @param string              $token
     * @param ValidationData|null $data
     * @return Token
     * @throws InvalidTokenException
     */
    public function parse($token, ValidationData $data = null): Token
    {
        $token = (new Parser())->parse((string) $token);

        if (!$token instanceof Token) {
            throw InvalidTokenException::notParsed();
        }

        if ($data instanceof ValidationData && !$this->validate($token, $data)) {
            throw InvalidTokenException::notValid();
        }

        if (!$this->verify($token)) {
            throw InvalidTokenException::notVerified();
        }

        return $token;
    }

    /**
     * Get path to file with public key
     * @return string
     */
    private function getPublicKeyPath()
    {
        return getcwd() . '/data/keys/jwt.pub';
    }
}
