<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Validation;

interface ConstraintViolationListInterface
{
    public function count(): int;
}