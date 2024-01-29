<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain\Factory;

use App\Auth\Authorization\Domain\GenerateAccessToken;
use App\Auth\Authorization\Domain\RefreshTokenSaveRepository;
use App\Auth\Authorization\Domain\TokenSaveRepository;
use App\Auth\Credential\Domain\Grant;

class AccessTokenFactory
{
    public function __construct(
        private readonly GenerateAccessToken $generateToken,
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly RefreshTokenSaveRepository $refreshTokenRepository,
    ) {
    }

    public function method(string $grantType): AccessTokenMethod
    {
        return match ($grantType) {
            Grant::PASSWORD->value           => new PasswordAccessTokenMethod(),
            Grant::CLIENT_CREDENTIALS->value => new ClientCredentialAccessTokenMethod(
                $this->tokenSaveRepository,
                $this->refreshTokenRepository,
                $this->generateToken,
            ),
            Grant::REFRESH_TOKEN->value => new RefreshTokenAccessTokenMethod(),
            default                     => throw new \InvalidArgumentException('Invalid grant type')
        };
    }
}
