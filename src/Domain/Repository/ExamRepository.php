<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Exam;

interface ExamRepository
{
    public function save(Exam $exam): Exam;
    public function clear(): void;
    public function count(): int;
}
