<?php

declare(strict_types=1);

namespace App\Infra\Repository\Memory;

use App\Domain\Entity\Discipline;
use App\Domain\Repository\DisciplineRepository;
use App\Exception\NotFoundException;

class DisciplineRepositoryMemory implements DisciplineRepository
{
    private array $disciplines = [];
    private int $id = 0;

    public function getById(int $idDiscipline): Discipline
    {
        if (!array_key_exists($idDiscipline, $this->disciplines)) {
            throw new NotFoundException("Discipline not found");
        }
        return $this->disciplines[$idDiscipline];
    }

    public function save(Discipline $discipline): Discipline
    {
        $this->id++;
        $discipline->setId($this->id);
        $this->disciplines[$this->id] = $discipline;
        return $discipline;
    }

    public function clear(): void
    {
        $this->id = 0;
        $this->disciplines = [];
    }
}
