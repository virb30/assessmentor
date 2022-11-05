<?php

declare(strict_types=1);

namespace App\Infra\Repository\Memory;

use App\Domain\Entity\Level;
use App\Domain\Repository\LevelRepository;
use App\Support\Exception\NotFoundException;

class LevelRepositoryMemory implements LevelRepository
{
    private array $levels = [];
    private int $id = 0;


    public function getById(int $idLevel): Level
    {
        if (!array_key_exists($idLevel, $this->levels)) {
            throw new NotFoundException("Level not found");
        }
        return $this->levels[$idLevel];
    }

    public function save(Level $level): Level
    {
        $this->id++;
        $this->levels[$this->id] = $level;
        return $level;
    }

    public function clear(): void
    {
        $this->id = 0;
        $this->levels = [];
    }
}
