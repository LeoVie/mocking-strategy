<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Validation;

readonly class ConstraintViolationList implements ConstraintViolationListInterface
{
    public function __construct(
        private array $violations
    ) {}

    public function count(): int
    {
        return count($this->violations);
    }
}