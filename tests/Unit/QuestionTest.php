<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Domain\Entity\Discipline;
use App\Domain\Entity\Level;
use App\Domain\Entity\Question;
use DomainException;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    public function testShouldCreateQuestionWithoutOptions()
    {
        $question = new Question(
            statement: 'Enunciado da pergunta',
            discipline: new Discipline(name: 'Língua portuguesa'),
            level: new Level(name: 'Ensino médio')
        );
        self::assertInstanceOf(Question::class, $question);
        self::assertTrue($question->isDiscursive());
        self::assertEquals('Língua portuguesa', $question->getDiscipline());
        self::assertEquals('Ensino médio', $question->getLevel());
        self::assertEquals('Enunciado da pergunta', $question->getStatement());
        self::assertEmpty($question->getOptions());
    }

    public function testShouldCreateQuestionAndSetId()
    {
        $question = new Question(
            statement: 'Enunciado da pergunta',
            discipline: new Discipline(name: 'Língua portuguesa'),
            level: new Level(name: 'Ensino médio')
        );
        self::assertInstanceOf(Question::class, $question);
        $question->setId(1);
        self::assertEquals(1, $question->getId());
    }

    public function testShouldCreateQuestionWithId()
    {
        $question = new Question(
            statement: 'Enunciado da pergunta',
            discipline: new Discipline(name: 'Língua portuguesa'),
            level: new Level(name: 'Ensino médio'),
            id: 1
        );
        self::assertInstanceOf(Question::class, $question);
        self::assertEquals(1, $question->getId());
    }

    public function testShouldNotCreateQuestionWithEmptyStatement()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Question statement must not be empty");

        new Question(
            statement: '',
            discipline: new Discipline(name: 'Língua portuguesa'),
            level: new Level(name: 'Ensino médio')
        );
    }

    public function testShouldCreateQuestionAndAddOptions()
    {
        $question = new Question(
            statement: 'Enunciado da pergunta',
            discipline: new Discipline(name: 'Matemática'),
            level: new Level(name: 'Ensino médio')
        );
        $question->addOption('Option 1', false);
        $question->addOption('Option 2', true);
        $question->addOption('Option 3', false);
        $question->addOption('Option 4', false);
        $question->addOption('Option 5', false);

        self::assertInstanceOf(Question::class, $question);
        self::assertFalse($question->isDiscursive());
        self::assertEquals('Matemática', $question->getDiscipline());
        self::assertEquals('Ensino médio', $question->getLevel());
        self::assertEquals('Enunciado da pergunta', $question->getStatement());
        $questionOptions = $question->getOptions();
        self::assertCount(5, $questionOptions);
        self::assertTrue($questionOptions[1]->isCorrect);
        self::assertFalse($questionOptions[0]->isCorrect);
    }
}
