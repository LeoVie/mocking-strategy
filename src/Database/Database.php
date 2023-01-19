<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\Database;

class Database
{
    private array $objects = [];

    public function persist(object $object): void
    {
        $this->simulateDBAccess();
        $this->objects[] = $object;
    }

    public function selectAll(): array
    {
        $this->simulateDBAccess();
        return $this->objects;
    }

    private function simulateDBAccess(): void
    {
        sleep(1);
        print("\nDATABASE_ACCESS\n");
    }
}