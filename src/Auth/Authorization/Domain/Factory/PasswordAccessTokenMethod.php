<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain\Factory;

use App\Auth\Authorization\Application\Command\GenerateTokenCommand;
use App\Auth\Authorization\Domain\AccessToken;
use App\Auth\Credential\Domain\Client;

final class PasswordAccessTokenMethod implements AccessTokenMethod
{
    public function __construct()
    {
    }

    public function getAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {
        return AccessToken::create(
            '',
            '',
            0,
            ''
        );
    }
}
