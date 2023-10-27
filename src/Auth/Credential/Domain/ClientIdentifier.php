<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

final class ClientIdentifier extends StringValueObject
{
    public function __toString(): string
    {
        return $this->value();
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * @throws \Exception
     */
    public static function generate(): self
    {
        return new self(hash('md5', random_bytes(16)));
    }

    public function value(): string
    {
        return $this->value;
    }
}
