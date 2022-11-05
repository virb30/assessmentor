<?php

declare(strict_types=1);

namespace App;

use DomainException;

class QuestionStatement
{
    public readonly string $value;

    public function __construct(string $statement)
    {
        if (empty($statement)) {
            throw new DomainException("Question statement must not be empty");
        }
        $this->value = $statement;
    }
}
