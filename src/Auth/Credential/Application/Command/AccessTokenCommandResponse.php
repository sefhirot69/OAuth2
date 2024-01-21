<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

use App\Auth\Credential\Domain\AccessToken;

final class AccessTokenCommandResponse implements \JsonSerializable
{
    public function __construct(
        private readonly string $tokenType,
        private readonly string $accessToken,
        private readonly int $expiresIn,
        private readonly string $refreshToken,
    ) {
    }

    public static function fromAccessToken(AccessToken $accessToken): self
    {
        return new self(
            $accessToken->getType(),
            $accessToken->getToken(),
            $accessToken->getExpiresIn(),
            $accessToken->getRefreshToken(),
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'token_type'    => $this->tokenType,
            'access_token'  => $this->accessToken,
            'expires_in'    => $this->expiresIn,
            'refresh_token' => $this->refreshToken,
        ];
    }
}
