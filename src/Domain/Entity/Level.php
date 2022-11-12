<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Level
{
    public function __construct(
        public readonly string $name,
        protected int $id = 0
    ) {
    }

    public function getName(): string
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
