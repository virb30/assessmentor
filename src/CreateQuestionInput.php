<?php

declare(strict_types=1);

namespace App;

class CreateQuestionInput
{
    public readonly array $options;

    public function __construct(
        public readonly string $statement,
        public readonly int $idLevel,
        public readonly int $idDiscipline,
        array $options = [],
    ) {
        $this->options = array_map(fn ($option) => (object)$option, $options);
    }
}
