<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\D\Validator;

use Leovie\MockingStrategy\Validation\ConstraintViolationList;
use Leovie\MockingStrategy\Validation\ConstraintViolationListInterface;
use Leovie\MockingStrategy\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /** @dataProvider validateProvider */
    public function testValidate(ConstraintViolationListInterface $expected, object $object): void
    {
        self::assertEquals($expected, (new Validator())->validate($object));
    }

    public function validateProvider(): array
    {
        $validObject = new \stdClass();
        $validObject->name = 'valid';

        $invalidObject = new \stdClass();
        $invalidObject->name = 'invalid';

        return [
            [
                'expected' => new ConstraintViolationList([]),
                'object' => $validObject
            ],
            [
                'expected' => new ConstraintViolationList(['name_not_valid']),
                'object' => $invalidObject
            ]
        ];
    }
}