<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

final class ClientScopes
{
    public function __construct(private array $values)
    {
    }

    public function getValues(): array
    {
        return $this->values;
    }
}
