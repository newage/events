<?php

declare(strict_types=1);

namespace Common\Container;

interface ConfigInterface
{
    public function get($keyString, $default = null);
}
