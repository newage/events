<?php

namespace Event\Common\Container;

use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;

interface JwtReaderInterface
{
    /**
     * Parse token
     * @param string              $token
     * @param ValidationData|null $data
     * @return Token
     */
    public function parse($token, ValidationData $data = null): Token;
}
