<?php

declare(strict_types=1);

namespace Leovie\MockingStrategy\D\Service;

use Leovie\MockingStrategy\Database\Database;
use Leovie\MockingStrategy\DTO\A;
use Leovie\MockingStrategy\Exception\ValidationException;
use Leovie\MockingStrategy\Validation\ValidatorInterface;

readonly class ServiceA
{
    public function __construct(
        private ValidatorInterface $validator,
        private Database $database
    ) {}

    /** @throws ValidationException */
    public function validateAndPersist(A $a): void
    {
        $errors = $this->validator->validate($a);

        if ($errors->count() !== 0) {
            throw new ValidationException();
        }

        $this->database->persist($a);
    }
}