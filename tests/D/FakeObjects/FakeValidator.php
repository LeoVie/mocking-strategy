<?php

namespace Leovie\MockingStrategy\Tests\D\FakeObjects;

use Leovie\MockingStrategy\Validation\ConstraintViolationListInterface;
use Leovie\MockingStrategy\Validation\ValidatorInterface;

class FakeValidator implements ValidatorInterface
{
    private array $validObjects = [];

    public function addValidObject(object $object): self
    {
        $this->validObjects[] = $object;

        return $this;
    }

    public function validate(object $object): ConstraintViolationListInterface
    {
        if (in_array($object, $this->validObjects)) {
            return new FakeViolationList(0);
        }

        return new FakeViolationList(1);
    }
}