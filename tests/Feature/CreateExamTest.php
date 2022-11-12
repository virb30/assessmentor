<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application\UseCase\CreateExam\CreateExam;
use App\Application\UseCase\CreateExam\CreateExamInput;
use App\Domain\Entity\Discipline;
use App\Domain\Entity\Level;
use App\Domain\Repository\DisciplineRepository;
use App\Domain\Repository\ExamRepository;
use App\Domain\Repository\LevelRepository;
use App\Exception\NotFoundException;
use App\Infra\Repository\Memory\DisciplineRepositoryMemory;
use App\Infra\Repository\Memory\ExamRepositoryMemory;
use App\Infra\Repository\Memory\LevelRepositoryMemory;
use PHPUnit\Framework\TestCase;

class CreateExamTest extends TestCase
{
    private DisciplineRepository $disciplineRepository;
    private ExamRepository $examRepository;
    private LevelRepository $levelRepository;

    protected function setUp(): void
    {
        $this->levelRepository = new LevelRepositoryMemory();
        $this->disciplineRepository = new DisciplineRepositoryMemory();
        $this->examRepository = new ExamRepositoryMemory();

        $this->levelRepository->clear();
        $this->disciplineRepository->clear();
        $this->examRepository->clear();
    }
    public function testShouldCreateAnExam()
    {
        $createExam = new CreateExam($this->levelRepository, $this->disciplineRepository, $this->examRepository);
        $this->disciplineRepository->save(new Discipline(id: 1, name: 'Matemática'));
        $this->disciplineRepository->save(new Discipline(id: 2, name: 'Português'));
        $this->disciplineRepository->save(new Discipline(id: 3, name: 'Física'));
        $this->disciplineRepository->save(new Discipline(id: 4, name: 'Biologia'));
        $this->levelRepository->save(new Level(id: 1, name: 'Ensino médio'));

        $input = new CreateExamInput(
            description: 'Exam 1',
            idLevel: 1,
            examDisciplines: [
                (object) ['idDiscipline' => 1, 'quantity' => 3],
                (object) ['idDiscipline' => 2, 'quantity' => 3],
                (object) ['idDiscipline' => 3, 'quantity' => 2],
                (object) ['idDiscipline' => 4, 'quantity' => 2],
            ]
        );
        $output = $createExam->execute($input);
        $total = $this->examRepository->count();
        self::assertEquals('Exam 1', $output->description);
        self::assertEquals(1, $output->idExam);
        self::assertEquals(1, $total);
    }

    public function testShouldThrowExceptionIfDisciplineNotFound()
    {
        $createExam = new CreateExam($this->levelRepository, $this->disciplineRepository, $this->examRepository);
        $this->levelRepository->save(new Level(id: 1, name: 'Ensino médio'));

        $input = new CreateExamInput(
            description: 'Exam 1',
            idLevel: 1,
            examDisciplines: [
                (object) ['idDiscipline' => 1, 'quantity' => 3],
            ]
        );

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("Discipline not found");
        $createExam->execute($input);
    }

    public function testShouldThrowExceptionIfLevelNotExists()
    {
        $createExam = new CreateExam($this->levelRepository, $this->disciplineRepository, $this->examRepository);
        $this->disciplineRepository->save(new Discipline(id: 1, name: 'Matemática'));
        $this->disciplineRepository->save(new Discipline(id: 2, name: 'Português'));

        $input = new CreateExamInput(
            description: 'Exam 1',
            idLevel: 1,
            examDisciplines: [
                (object) ['idDiscipline' => 1, 'quantity' => 3],
                (object) ['idDiscipline' => 2, 'quantity' => 3],
            ]
        );

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("Level not found");
        $createExam->execute($input);
    }
}
