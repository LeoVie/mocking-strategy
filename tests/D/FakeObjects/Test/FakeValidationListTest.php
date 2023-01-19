<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Tests\D\FakeObjects\Test;

use Leovie\MockingStrategy\Tests\D\FakeObjects\FakeViolationList;
use PHPUnit\Framework\TestCase;

class FakeValidationListTest extends TestCase
{
    public function testCount(): void
    {
        self::assertSame(10, (new FakeViolationList(10))->count());
    }
}