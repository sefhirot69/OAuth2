<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain\Factory;

use App\Auth\Authorization\Application\Command\GenerateTokenCommand;
use App\Auth\Authorization\Domain\AccessToken;
use App\Auth\Authorization\Domain\Token;
use App\Auth\Authorization\Domain\TokenSaveRepository;
use App\Auth\Credential\Domain\Client;

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
            Token::create(
                $client,
                new \DateTimeImmutable('+8 hour'),
            )
        );

        return AccessToken::create(
            '',
            '',
            0,
            ''
        );
    }
}
