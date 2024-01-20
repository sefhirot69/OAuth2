<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

final class GenerateTokenCommand
{
    public function __construct(
        private readonly string $grantType,
        private readonly string $clientId,
        private readonly string $clientSecret,
    ) {
    }

    public function getGrantType(): string
    {
        return $this->grantType;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }
}
