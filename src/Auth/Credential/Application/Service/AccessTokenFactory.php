<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Service;

use App\Auth\Credential\Domain\Grant;

class AccessTokenFactory
{
    public function method(string $grantType): AccessTokenMethod
    {
        return match ($grantType) {
            Grant::PASSWORD->value           => new PasswordAccessTokenMethod(),
            Grant::CLIENT_CREDENTIALS->value => new ClientCredentialAccessTokenMethod(),
            Grant::REFRESH_TOKEN->value      => new RefreshTokenAccessTokenMethod(),
            default                          => throw new \InvalidArgumentException('Invalid grant type')
        };
    }
}
