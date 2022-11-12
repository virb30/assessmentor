<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DomainException;

class Discipline
{
    public function __construct(
        protected string $name,
        protected int $id = 0,
    ) {
        $this->id = $id;
        if (empty($name)) {
            throw new DomainException("Please provide a name for discipline");
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
