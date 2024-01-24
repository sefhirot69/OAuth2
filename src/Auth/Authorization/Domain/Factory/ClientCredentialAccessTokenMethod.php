<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain\Factory;

use App\Auth\Authorization\Application\Command\GenerateTokenCommand;
use App\Auth\Authorization\Domain\AccessToken;
use App\Auth\Authorization\Domain\GenerateAccessToken;
use App\Auth\Authorization\Domain\RefreshToken;
use App\Auth\Authorization\Domain\Token;
use App\Auth\Authorization\Domain\TokenSaveRepository;
use App\Auth\Credential\Domain\Client;

class ClientCredentialAccessTokenMethod implements AccessTokenMethod
{
    public function __construct(
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateAccessToken $generateToken,
    ) {
    }

    public function getAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {
        $token = Token::create(
            $client,
            new \DateTimeImmutable('+8 hour'), // TODO valueObject
        );

        $this->tokenSaveRepository->save(
            $token
        );

        $refreshToken = RefreshToken::create(
            $token,
            new \DateTimeImmutable('+1 month'), // TODO valueObject
        );

        // TODO implement RefreshTokenRepository

        return $this->generateToken->generateAccessToken($token, $refreshToken);
    }
}
