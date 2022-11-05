<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Question
{
    private QuestionStatement $statement;
    private array $options = [];

    public function __construct(
        string $statement,
        protected Discipline $discipline,
        protected Level $level
    ) {
        $this->statement = new QuestionStatement($statement);
    }

    public function isDiscursive(): bool
    {
        return empty($this->options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getLevel(): string
    {
        return $this->level->getName();
    }

    public function getDiscipline(): string
    {
        return $this->discipline->getName();
    }

    public function getStatement(): string
    {
        return $this->statement->value;
    }

    public function addOption($statement, $isCorrect = false): void
    {
        array_push($this->options, new QuestionOption($statement, $isCorrect));
    }
}
