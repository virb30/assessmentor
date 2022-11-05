<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Level;

interface LevelRepository
{
    public function getById(int $idLevel): Level;
    public function save(Level $level): Level;
    public function clear(): void;
}
