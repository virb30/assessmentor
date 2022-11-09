<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Discipline;

interface DisciplineRepository
{
    public function getById(int $idDiscipline): Discipline;
    public function save(Discipline $discipline): Discipline;

    public function clear(): void;
}
