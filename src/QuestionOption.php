<?php

declare(strict_types=1);

namespace App;

class QuestionOption
{
    public function __construct(
        public readonly string $statement,
        public readonly bool $isCorrect
    ) {
    }
}
