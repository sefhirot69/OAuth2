<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

final class ClientRedirectUris
{
    public function __construct(private array $values)
    {
        $this->ensureIsValidUrl($values);
    }

    public function getValues(): array
    {
        return $this->values;
    }

    private function ensureIsValidUrl(array $values): void
    {
        foreach ($values as $value) {
            if (!filter_var($value, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException(sprintf('The redirectUris <%s> is not valid', $value));
            }
        }
    }
}
