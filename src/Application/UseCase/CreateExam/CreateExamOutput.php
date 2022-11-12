<?php

declare(strict_types=1);

namespace App\Application\UseCase\CreateExam;

class CreateExamOutput
{
    public function __construct(
        public readonly string $description,
        public readonly int $idExam
    ) {
    }
}
