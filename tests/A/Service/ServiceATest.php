<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\A\Service;

use Leovie\MockingStrategy\A\Service\ServiceA;
use Leovie\MockingStrategy\Database\Database;
use Leovie\MockingStrategy\DTO\A;
use Leovie\MockingStrategy\Exception\ValidationException;
use Leovie\MockingStrategy\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ServiceATest extends TestCase
{
    public function testValidateAndPersistThrows(): void
    {
        $validator = new Validator();
        $database = new Database();

        self::expectException(ValidationException::class);

        (new ServiceA($validator, $database))->validateAndPersist(new A('invalid'));
    }

    public function testValidateAndPersist(): void
    {
        $a = new A('valid');

        $validator = new Validator();
        $database = new Database();

        (new ServiceA($validator, $database))->validateAndPersist($a);
        self::assertContains($a, $database->selectAll());
    }
}