<?php

declare(strict_types=1);

namespace App\Application\UseCase\CreateQuestion;

class CreateQuestionOutput
{
    public function __construct(
        public string $statement,
        public array $options = [],
    ) {
        $this->options = array_map(fn ($option) => (array) $option, $options);
    }
}
