<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Level
{
    public function __construct(
        public readonly string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}