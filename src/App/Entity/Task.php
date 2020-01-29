<?php

declare(strict_types=1);

namespace Event\App\Entity;

use Laminas\InputFilter\Input;
use Laminas\Validator;

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
        return !empty($this->id) ? (int)$this->id : null;
    }

    /**
     * @param mixed $id
     * @return Task
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
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
        $this->name = $name;
        return $this;
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
        $this->description = $description;
        return $this;
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
        $this->dtCreated = $dtCreated;
        return $this;
    }

    public static function validationName(): Input
    {
        $input = new Input('name');
        $input->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\StringLength(['min'=>1,'max'=>15]));
        return $input;
    }

    public static function validationDescription(): Input
    {
        $input = new Input('description');
        $input->getValidatorChain()
            ->attach(new Validator\StringLength(['min'=>5,'max'=>255]));
        return $input;
    }
}