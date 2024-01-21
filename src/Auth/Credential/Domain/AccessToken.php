<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

class AccessToken
{
    private function __construct(
        private readonly string $token,
        private readonly string $type,
        private readonly int $expiresIn,
        private readonly string $refreshToken,
    ) {
    }

    public static function create(
        string $token,
        string $type,
        int $expiresIn,
        string $refreshToken,
    ): self {
        return new self(
            $token,
            $type,
            $expiresIn,
            $refreshToken,
        );
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}
