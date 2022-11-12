<?php

declare(strict_types=1);

namespace App\Application\UseCase\CreateExam;

use App\Domain\Entity\Exam;
use App\Domain\Repository\DisciplineRepository;
use App\Domain\Repository\ExamRepository;
use App\Domain\Repository\LevelRepository;

class CreateExam
{
    public function __construct(
        private LevelRepository $levelRepository,
        private DisciplineRepository $disciplineRepository,
        private ExamRepository $examRepository
    ) {
    }

    public function execute(CreateExamInput $input): CreateExamOutput
    {
        $level = $this->levelRepository->getById($input->idLevel);
        $exam = new Exam($input->description, $level);
        foreach ($input->examDisciplines as $examDiscipline) {
            $discipline = $this->disciplineRepository->getById($examDiscipline->idDiscipline);
            $exam->addExamDiscipline($discipline, $examDiscipline->quantity);
        }
        $exam = $this->examRepository->save($exam);
        return new CreateExamOutput(
            idExam: $exam->getId(),
            description: $exam->description,
        );
    }
}
