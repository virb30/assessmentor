<?php

declare(strict_types=1);

namespace App\Infra\Repository\Memory;

use App\Domain\Entity\Exam;
use App\Domain\Repository\ExamRepository;

class ExamRepositoryMemory implements ExamRepository
{
    private array $exams = [];
    private int $id = 0;


    public function save(Exam $exam): Exam
    {
        $this->id++;
        $exam->setId($this->id);
        $this->exams[$this->id] = $exam;
        return $exam;
    }

    public function clear(): void
    {
        $this->id = 0;
        $this->exams = [];
    }

    public function count(): int
    {
        return sizeof($this->exams);
    }
}
