<?php

declare(strict_types=1);

namespace App\Application\UseCase\CreateExam;

use stdClass;

/**
 * @property int $idDiscipline
 * @property int $quantity
 */
class ExamDisciplineInput extends stdClass
{
}

class CreateExamInput
{
    /**
     * @param string $description
     * @param integer $idLevel
     * @param ExamDisciplineInput[] $examDisciplines
     */
    public function __construct(
        public readonly string $description,
        public readonly int $idLevel,
        public readonly array $examDisciplines,

    ) {
    }
}
