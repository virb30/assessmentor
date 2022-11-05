<?php

declare(strict_types=1);

namespace App;

interface DisciplineRepository
{
    public function getById(int $idDiscipline): Discipline;
    public function save(Discipline $discipline): Discipline;
    public function clear(): void;
}
