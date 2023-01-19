<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\D\Service;

use Leovie\MockingStrategy\Database\Database;
use Leovie\MockingStrategy\DTO\B;
use Leovie\MockingStrategy\Exception\ValidationException;
use Leovie\MockingStrategy\D\Service\ServiceB;
use Leovie\MockingStrategy\Tests\D\FakeObjects\FakeValidator;
use PHPUnit\Framework\TestCase;

class ServiceBTest extends TestCase
{
    public function testValidateAndPersistThrows(): void
    {
        $validator = new FakeValidator();
        $database = $this->createMock(Database::class);

        self::expectException(ValidationException::class);

        (new ServiceB($validator, $database))->validateAndPersist(new B(''));
    }

    public function testValidateAndPersist(): void
    {
        $b = new B('');

        $validator = (new FakeValidator())
            ->addValidObject($b);

        $database = $this->createMock(Database::class);
        $database->expects(self::once())
            ->method('persist')
            ->with($b);

        (new ServiceB($validator, $database))->validateAndPersist($b);
    }
}