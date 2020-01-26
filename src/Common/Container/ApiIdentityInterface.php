<?php

namespace Event\Common\Container;

/**
 * Class ApiIdentityInterface
 * @package Common\Api\Container
 */
interface ApiIdentityInterface
{

    /**
     * @return mixed
     */
    public function getUserId();

    /**
     * @return mixed
     */
    public function getRole();
}
