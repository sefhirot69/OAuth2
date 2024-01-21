<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Service;

use App\Auth\Credential\Domain\AccessToken;

class ClientCredentialAccessTokenMethod implements AccessTokenMethod
{
    public function __construct()
    {
    }

    public function getAccessToken(): AccessToken
    {
        return AccessToken::create(
            '',
            '',
            0,
            ''
        );
    }
}
