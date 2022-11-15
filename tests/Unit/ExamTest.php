<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Domain\Entity\Discipline;
use App\Domain\Entity\Exam;
use App\Domain\Entity\Level;
use DomainException;
use PHPUnit\Framework\TestCase;

class ExamTest extends TestCase
{
    public function testShouldCreateAnExamAndAddDisciplines()
    {
        $exam = new Exam("Exam 1", new Level(id: 1, name: 'Ensino médio'));

        $exam->addExamDiscipline(new Discipline('Matemática', 1), 3);
        $exam->addExamDiscipline(new Discipline('Português', 2), 3);
        $exam->addExamDiscipline(new Discipline('Física', 3), 2);
        $exam->addExamDiscipline(new Discipline('Biologia', 4), 2);

        self::assertInstanceOf(Exam::class, $exam);
        self::assertEquals("Exam 1", $exam->description);
        self::assertEquals(1, $exam->idLevel);
        self::assertCount(4, $exam->getExamDisciplines());
    }

    public function testShouldNotAddDuplicateDisciplineOnExam()
    {
        $exam = new Exam("Exam 1", new Level(id: 1, name: 'Ensino médio'));

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Duplicated discipline");

        $exam->addExamDiscipline(new Discipline('Matemática', 1), 3);
        $exam->addExamDiscipline(new Discipline('Matemática', 1), 2);
        $exam->addExamDiscipline(new Discipline('Física', 3), 2);
        $exam->addExamDiscipline(new Discipline('Biologia', 4), 2);
    }

    public function testShouldNotCreateAnExamWithoutDescription()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Please provide a description for the exam");
        new Exam("", new Level(id: 1, name: 'Ensino médio'));
    }

    public function testShouldNotAddDisciplineOnExamWithInvalidQuantity()
    {
        $exam = new Exam("Exam 1", new Level(id: 1, name: 'Ensino médio'));

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Please provide a valid quantity");

        $exam->addExamDiscipline(new Discipline('Matemática', 1), 0);
    }
}
