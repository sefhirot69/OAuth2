<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Infrastructure\JsonWebToken;

use App\Auth\Authorization\Domain\AccessToken;
use App\Auth\Authorization\Domain\GenerateAccessToken;
use App\Auth\Authorization\Domain\RefreshToken;
use App\Auth\Authorization\Domain\Token;
use App\Shared\Domain\Utils\Key\CryptKeyPrivate;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class LcobucciGenerateAccessToken implements GenerateAccessToken
{
    private string $privateKey;
    //    private string $publicKey;

    public function __construct(
        private readonly ParameterBagInterface $parameterBag,
    ) {
        $privateKey = $this->parameterBag->get('private_key');

        if (!is_string($privateKey)) {
            throw new \InvalidArgumentException('Private key not found');
        }

        $this->privateKey = $privateKey;

        //        $publicKey = $this->parameterBag->get('public_key');
        //
        //        if (!is_string($publicKey)) {
        //            throw new \InvalidArgumentException('Public key not found');
        //        }
        //
        //        $this->publicKey = $publicKey;
    }

    public function generateAccessToken(Token $token, RefreshToken $refreshToken): AccessToken
    {
        $privateKey    = CryptKeyPrivate::create($this->privateKey);
        $configuration = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::plainText($privateKey->getKeyContents(), $privateKey->getPassPhrase() ?? ''),
            InMemory::plainText('empty', 'empty'),
        );

        /** @phpstan-ignore-next-line */
        $jwtToken = $configuration->builder()
            ->permittedFor($token->getClientIdentifier())
            ->identifiedBy($token->getId()->toString())
            ->issuedAt(new \DateTimeImmutable())
            ->expiresAt($token->getExpiresIn())
            ->canOnlyBeUsedAfter(new \DateTimeImmutable())
            ->withClaim('scopes', $token->getScopes())
            ->getToken($configuration->signer(), $configuration->signingKey());

        /** @phpstan-ignore-next-line */
        $jwtRefreshToken = $configuration->builder()
            ->permittedFor($refreshToken->getClientIdentifier())
            ->identifiedBy($refreshToken->getId()->toString())
            ->issuedAt(new \DateTimeImmutable())
            ->expiresAt($refreshToken->getExpiresIn())
            ->canOnlyBeUsedAfter(new \DateTimeImmutable())
            ->withClaim('scopes', $refreshToken->getScopes())
            ->getToken($configuration->signer(), $configuration->signingKey());

        return AccessToken::create(
            $jwtToken->toString(),
            'bearer', // TODO: change this for enum
            $token->getExpiresIn()->getTimestamp(),
            $jwtRefreshToken->toString(),
        );
    }
}
