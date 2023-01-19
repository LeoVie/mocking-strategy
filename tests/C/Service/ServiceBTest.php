<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\C\Service;

use Leovie\MockingStrategy\Database\Database;
use Leovie\MockingStrategy\DTO\B;
use Leovie\MockingStrategy\Exception\ValidationException;
use Leovie\MockingStrategy\C\Service\ServiceB;
use Leovie\MockingStrategy\Validation\ConstraintViolationListInterface;
use Leovie\MockingStrategy\Validation\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class ServiceBTest extends TestCase
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

        (new ServiceB($validator, $database))->validateAndPersist(new B(''));
    }

    public function testValidateAndPersist(): void
    {
        $b = new B('');

        $constraintViolationList = $this->createMock(ConstraintViolationListInterface::class);
        $constraintViolationList->method('count')
            ->willReturn(0);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->method('validate')
            ->willReturn($constraintViolationList);

        $database = $this->createMock(Database::class);
        $database->expects(self::once())
            ->method('persist')
            ->with($b);

        (new ServiceB($validator, $database))->validateAndPersist($b);
    }
}