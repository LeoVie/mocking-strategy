<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\C\Service;

use Leovie\MockingStrategy\Database\Database;
use Leovie\MockingStrategy\Exception\ValidationException;
use Leovie\MockingStrategy\DTO\B;
use Leovie\MockingStrategy\Validation\ValidatorInterface;

readonly class ServiceB
{
    public function __construct(
        private ValidatorInterface $validator,
        private Database $database
    ) {}

    /** @throws ValidationException */
    public function validateAndPersist(B $b): void
    {
        $errors = $this->validator->validate($b);

        if ($errors->count() !== 0) {
            throw new ValidationException();
        }

        $this->database->persist($b);
    }
}