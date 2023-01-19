<?php

namespace Leovie\MockingStrategy\Tests\D\FakeObjects;

use Leovie\MockingStrategy\Validation\ConstraintViolationListInterface;

readonly class FakeViolationList implements ConstraintViolationListInterface
{
    public function __construct(
        private int $count,
    ) {}

    public function count(): int
    {
        return $this->count;
    }
}