<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Validation;

interface ValidatorInterface
{
    public function validate(object $object): ConstraintViolationListInterface;
}