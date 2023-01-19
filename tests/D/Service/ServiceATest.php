<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\D\Service;

use Leovie\MockingStrategy\Database\Database;
use Leovie\MockingStrategy\DTO\A;
use Leovie\MockingStrategy\Exception\ValidationException;
use Leovie\MockingStrategy\D\Service\ServiceA;
use Leovie\MockingStrategy\Tests\D\FakeObjects\FakeValidator;
use PHPUnit\Framework\TestCase;

class ServiceATest extends TestCase
{
    public function testValidateAndPersistThrows(): void
    {
        $validator = new FakeValidator();
        $database = $this->createMock(Database::class);

        self::expectException(ValidationException::class);

        (new ServiceA($validator, $database))->validateAndPersist(new A(''));
    }

    public function testValidateAndPersist(): void
    {
        $a = new A('');

        $validator = (new FakeValidator())
            ->addValidObject($a);

        $database = $this->createMock(Database::class);
        $database->expects(self::once())
            ->method('persist')
            ->with($a);

        (new ServiceA($validator, $database))->validateAndPersist($a);
    }
}