<?php

declare(strict_types=1);

namespace App;

class CreateQuestion
{
    public function __construct(
        private QuestionRepository $questionRepository,
        private DisciplineRepository $disciplineRepository,
        private LevelRepository $levelRepository,
    ) {
    }

    public function execute(CreateQuestionInput $input)
    {
        $discipline = $this->disciplineRepository->getById($input->idDiscipline);
        $level = $this->levelRepository->getById($input->idLevel);
        $question = new Question($input->statement, $discipline, $level);
        foreach ($input->options as $option) {
            $question->addOption($option->statement, $option->isCorrect);
        }
        $this->questionRepository->save($question);
        $output = new CreateQuestionOutput(
            statement: $question->getStatement(),
            options: $question->getOptions()
        );
        return $output;
    }
}
