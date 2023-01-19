<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\D\FakeObjects\Test;

use Leovie\MockingStrategy\Tests\D\FakeObjects\FakeValidator;
use Leovie\MockingStrategy\Tests\D\FakeObjects\FakeViolationList;
use Leovie\MockingStrategy\Validation\ConstraintViolationListInterface;
use PHPUnit\Framework\TestCase;

class FakeValidatorTest extends TestCase
{
    /** @dataProvider validateProvider */
    public function testValidate(ConstraintViolationListInterface $expected, FakeValidator $validator, object $object): void
    {
        self::assertEquals($expected, $validator->validate($object));
    }

    public function validateProvider(): array
    {
        $object = new \stdClass();
        return [
            'with validation' => [
                new FakeViolationList(1),
                new FakeValidator(),
                $object,
            ],
            'without validation' => [
                new FakeViolationList(0),
                (new FakeValidator())->addValidObject($object),
                $object,
            ],
        ];
    }
}