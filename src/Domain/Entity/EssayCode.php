<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTimeInterface;
use DomainException;

class EssayCode
{
    public readonly string $value;

    public function __construct(
        string $code,
        DateTimeInterface $examDate
    ) {
        if (empty($code)) {
            throw new DomainException("Exam code is required");
        }
        $this->value = $this->generateCode($code, $examDate);
    }

    public function generateCode($code, $date)
    {
        $suffix = $date->format('Ymdhis');
        return $code . '-' . $suffix;
    }
}
