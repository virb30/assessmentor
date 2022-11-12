<?php

declare(strict_types=1);

namespace App\Infra\Repository\Memory;

use App\Domain\Entity\Question;
use App\Domain\Repository\QuestionRepository;

class QuestionRepositoryMemory implements QuestionRepository
{
    private array $questions = [];
    private int $id = 0;

    public function save(Question $question): Question
    {
        $this->id++;
        $question->setId($this->id);
        $this->questions[$this->id] = $question;
        return $question;
    }

    public function clear(): void
    {
        $this->id = 0;
        $this->questions = [];
    }

    public function count(): int
    {
        return sizeof($this->questions);
    }
}
