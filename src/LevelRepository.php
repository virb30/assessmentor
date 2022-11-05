<?php

declare(strict_types=1);

namespace App;

interface LevelRepository
{
    public function getById(int $idLevel): Level;
    public function save(Level $level): Level;
    public function clear(): void;
}
