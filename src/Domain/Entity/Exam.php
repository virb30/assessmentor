<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Support\Arr;
use DomainException;

class Exam
{
    protected Level $examLevel;

    /**
     * @var ExamDiscipline[]
     */
    protected array $examDisciplines = [];
    public readonly string $description;
    public readonly int $idLevel;

    public function __construct(
        string $description,
        Level $level,
        protected int $id = 0
    ) {
        if (empty($description)) {
            throw new DomainException("Please provide a description for the exam");
        }
        $this->description = $description;
        $this->idLevel = $level->getId();
    }

    public function addExamDiscipline(Discipline $discipline, int $quantity)
    {
        $examDisciplineExists = Arr::exists($this->examDisciplines, fn ($examDiscipline) => $examDiscipline->idDiscipline === $discipline->getId());
        if ($examDisciplineExists) {
            throw new DomainException("Duplicated discipline");
        }
        $examDiscipline = new ExamDiscipline($discipline->getId(), $quantity);
        array_push($this->examDisciplines, $examDiscipline);
    }

    public function getExamDisciplines(): array
    {
        return $this->examDisciplines;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
