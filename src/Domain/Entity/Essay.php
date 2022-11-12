<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;

class Essay
{
    /**
     * @var App\Domain\Entity\Question[]
     */
    protected array $questions = [];
    private EssayCode $code;

    public function __construct(
        string $code,
        DateTimeInterface $examDate = new DateTimeImmutable()
    ) {
        $this->code = new EssayCode($code, $examDate);
    }

    public function addQuestion(Question $question): void
    {
        $this->questions[] = $question;
    }

    /**
     * @return Question[]
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function getCode(): string
    {
        return $this->code->value;
    }
}
