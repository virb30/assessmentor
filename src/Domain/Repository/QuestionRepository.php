<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Question;

interface QuestionRepository
{
    public function save(Question $question): Question;
    public function clear(): void;
    public function count(): int;
}
