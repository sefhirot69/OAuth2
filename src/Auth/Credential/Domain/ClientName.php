<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

final class ClientName extends StringValueObject
{
    public function __toString(): string
    {
        return $this->value();
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
