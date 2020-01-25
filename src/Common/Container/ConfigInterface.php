<?php

declare(strict_types=1);

namespace Event\Common\Container;

interface ConfigInterface
{
    public function get($keyString, $default = null);
}
