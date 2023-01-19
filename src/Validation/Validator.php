<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Validation;

class Validator implements ValidatorInterface
{
    public function validate(object $object): ConstraintViolationListInterface
    {
        if ($object->name === 'valid') {
            return new ConstraintViolationList([]);
        }

        return new ConstraintViolationList(['name_not_valid']);
    }
}