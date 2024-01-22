<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Service;

use App\Auth\Credential\Application\Command\GenerateTokenCommand;
use App\Auth\Credential\Domain\AccessToken;
use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\Token;
use App\Auth\Credential\Domain\TokenSaveRepository;

class ClientCredentialAccessTokenMethod implements AccessTokenMethod
{
    public function __construct(
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateToken $generateToken,
    ) {
    }

    public function getAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {
        $this->tokenSaveRepository->save(
            new Token()
        );

        return AccessToken::create(
            '',
            '',
            0,
            ''
        );
    }
}
