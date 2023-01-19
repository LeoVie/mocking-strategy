<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\C\Service;

use Leovie\MockingStrategy\Database\Database;
use Leovie\MockingStrategy\DTO\A;
use Leovie\MockingStrategy\Exception\ValidationException;
use Leovie\MockingStrategy\C\Service\ServiceA;
use Leovie\MockingStrategy\Validation\ConstraintViolationListInterface;
use Leovie\MockingStrategy\Validation\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class ServiceATest extends TestCase
{
    public function testValidateAndPersistThrows(): void
    {
        $constraintViolationList = $this->createMock(ConstraintViolationListInterface::class);
        $constraintViolationList->method('count')
            ->willReturn(1);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->method('validate')
            ->willReturn($constraintViolationList);

        $database = $this->createMock(Database::class);

        self::expectException(ValidationException::class);

        (new ServiceA($validator, $database))->validateAndPersist(new A(''));
    }

    public function testValidateAndPersist(): void
    {
        $a = new A('');

        $constraintViolationList = $this->createMock(ConstraintViolationListInterface::class);
        $constraintViolationList->method('count')
            ->willReturn(0);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->method('validate')
            ->willReturn($constraintViolationList);

        $database = $this->createMock(Database::class);
        $database->expects(self::once())
            ->method('persist')
            ->with($a);

        (new ServiceA($validator, $database))->validateAndPersist($a);
    }
}