<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Domain\Entity\Discipline;
use App\Domain\Entity\Essay;
use App\Domain\Entity\Level;
use App\Domain\Entity\Question;
use DateTimeImmutable;
use DomainException;
use PHPUnit\Framework\TestCase;

class EssayTest extends TestCase
{
    public function testShouldCreateAnEssayAndAddQuestions()
    {
        $essay = new Essay("valid-code", new DateTimeImmutable('2022-01-01 12:00:00'));
        $essay->addQuestion(
            new Question(
                statement: 'Pergunta 1',
                discipline: new Discipline(name: 'Matemática'),
                level: new Level(name: 'Ensino médio')
            )
        );
        $essay->addQuestion(
            new Question(
                statement: 'Pergunta 2',
                discipline: new Discipline(name: 'Matemática'),
                level: new Level(name: 'Ensino médio')
            )
        );
        $essay->addQuestion(
            new Question(
                statement: 'Pergunta 3',
                discipline: new Discipline(name: 'Matemática'),
                level: new Level(name: 'Ensino médio')
            )
        );

        self::assertInstanceOf(Essay::class, $essay);
        self::assertEquals('valid-code-20220101120000', $essay->getCode());
        self::assertCount(3, $essay->getQuestions());
    }

    public function testShouldNotCreateEssayWithEmptyCode()
    {
        $this->expectException(DomainException::class);
        new Essay('');
    }
}
