<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Service;

use App\Auth\Credential\Application\Command\GenerateTokenCommand;
use App\Auth\Credential\Domain\AccessToken;
use App\Auth\Credential\Domain\Client;

final class RefreshTokenAccessTokenMethod implements AccessTokenMethod
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
