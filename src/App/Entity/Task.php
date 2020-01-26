<?php

declare(strict_types=1);

namespace Event\App\Entity;

final class Task
{
    private $id;
    private $name;
    private $description;
    private $dtCreated;

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return (int)$this->id;
    }

    /**
     * @param mixed $id
     * @return Task
     */
    public function setId($id): self
    {
        $cloneObject = clone $this;
        $cloneObject->id = $id;
        return $cloneObject;
    }

    /**
     * @return mixed
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Task
     */
    public function setName($name): self
    {
        $cloneObject = clone $this;
        $cloneObject->name = $name;
        return $cloneObject;
    }

    /**
     * @return mixed
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Task
     */
    public function setDescription($description): self
    {
        $cloneObject = clone $this;
        $cloneObject->description = $description;
        return $cloneObject;
    }

    /**
     * @return mixed
     */
    public function getDtCreated(): ?string
    {
        return $this->dtCreated;
    }

    /**
     * @param mixed $dtCreated
     * @return Task
     */
    public function setDtCreated($dtCreated): self
    {
        $cloneObject = clone $this;
        $cloneObject->dtCreated = $dtCreated;
        return $cloneObject;
    }
}