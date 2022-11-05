<?php

declare(strict_types=1);

namespace App;

class Discipline
{
    public function __construct(
        protected string $name
    ) {
    }

    public function getName()
    {
        return $this->name;
    }
}
