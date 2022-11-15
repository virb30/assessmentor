<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Domain\Entity\Discipline;
use DomainException;
use PHPUnit\Framework\TestCase;

class DisciplineTest extends TestCase
{
    public function testShouldCreateDiscipline()
    {
        $discipline = new Discipline("Matemática");
        self::assertInstanceOf(Discipline::class, $discipline);
        self::assertEquals("Matemática", $discipline->getName());
    }

    public function testShouldNotCreateDisciplineWithInvalidName()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Please provide a name for discipline");
        new Discipline("");
    }
}
