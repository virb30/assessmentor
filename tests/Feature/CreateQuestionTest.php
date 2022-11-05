<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\CreateQuestion;
use App\CreateQuestionInput;
use App\CreateQuestionOutput;
use App\Discipline;
use App\DisciplineRepository;
use App\DisciplineRepositoryMemory;
use App\Level;
use App\LevelRepository;
use App\LevelRepositoryMemory;
use App\NotFoundException;
use App\QuestionRepository;
use App\QuestionRepositoryMemory;
use PHPUnit\Framework\TestCase;

class CreateQuestionText extends TestCase
{
    private DisciplineRepository $disciplineRepository;
    private LevelRepository $levelRepository;
    private QuestionRepository $questionRepository;
    private CreateQuestion $createQuestion;

    protected function setUp(): void
    {
        $this->disciplineRepository = new DisciplineRepositoryMemory();
        $this->levelRepository = new LevelRepositoryMemory();
        $this->questionRepository = new QuestionRepositoryMemory();
        $this->createQuestion = new CreateQuestion(
            disciplineRepository: $this->disciplineRepository,
            questionRepository: $this->questionRepository,
            levelRepository: $this->levelRepository
        );
    }

    protected function tearDown(): void
    {
        $this->disciplineRepository->clear();
        $this->levelRepository->clear();
        $this->questionRepository->clear();
    }

    public function testShouldCreateQuestion()
    {
        $this->disciplineRepository->save(new Discipline('Matemática'));
        $this->levelRepository->save(new Level('Ensino médio'));

        $input = new CreateQuestionInput(
            statement: 'Test question',
            options: [
                ['statement' => 'Option 1', 'isCorrect' => false],
                ['statement' => 'Option 1', 'isCorrect' => false],
                ['statement' => 'Option 1', 'isCorrect' => true],
            ],
            idLevel: 1,
            idDiscipline: 1
        );

        $output = $this->createQuestion->execute($input);

        self::assertInstanceOf(CreateQuestionOutput::class, $output);
        self::assertEquals('Test question', $output->statement);
        self::assertCount(3, $output->options);
        self::assertEquals(1, $this->questionRepository->count());
    }

    public function testShouldThrowExceptionIfDisciplineNotExists()
    {
        $this->levelRepository->save(new Level('Ensino médio'));

        $input = new CreateQuestionInput(
            statement: 'Test question',
            options: [
                ['statement' => 'Option 1', 'isCorrect' => false],
                ['statement' => 'Option 1', 'isCorrect' => false],
                ['statement' => 'Option 1', 'isCorrect' => true],
            ],
            idLevel: 1,
            idDiscipline: 1
        );

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Discipline not found');

        $this->createQuestion->execute($input);

        self::assertEquals(0, $this->questionRepository->count());
    }

    public function testShouldThrowExceptionIfLevelNotExists()
    {
        $this->disciplineRepository->save(new Discipline('Matemática'));

        $input = new CreateQuestionInput(
            statement: 'Test question',
            options: [
                ['statement' => 'Option 1', 'isCorrect' => false],
                ['statement' => 'Option 1', 'isCorrect' => false],
                ['statement' => 'Option 1', 'isCorrect' => true],
            ],
            idLevel: 1,
            idDiscipline: 1
        );

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Level not found');

        $this->createQuestion->execute($input);

        self::assertEquals(0, $this->questionRepository->count());
    }
}
