<?php

namespace Event\Common\Container;

/**
 * Class AuthorizeContainer
 * @package Common\Api\Container
 */
class Identity implements ApiIdentityInterface
{
    protected $tokenIdentifier;
    protected $userId;
    protected $role;

    /**
     * @return mixed
     */
    public function getTokenIdentifier()
    {
        return $this->tokenIdentifier;
    }

    /**
     * @param mixed $tokenIdentifier
     * @return Identity
     */
    public function setTokenIdentifier($tokenIdentifier)
    {
        $cloneObject = clone $this;
        $cloneObject->tokenIdentifier = $tokenIdentifier;
        return $cloneObject;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return Identity
     */
    public function setUserId($userId)
    {
        $cloneObject = clone $this;
        $cloneObject->userId = $userId;
        return $cloneObject;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return Identity
     */
    public function setRole($role)
    {
        $cloneObject = clone $this;
        $cloneObject->role = $role;
        return $cloneObject;
    }
}
