<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DomainException;

class ExamDiscipline
{
    public function __construct(
        public readonly int $idDiscipline,
        public readonly int $quantity
    ) {
        if ($quantity <= 0) {
            throw new DomainException("Please provide a valid quantity");
        }
    }
}
