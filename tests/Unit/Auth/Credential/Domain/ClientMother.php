<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\ClientCredentialParam;
use App\Auth\Credential\Domain\Grant;
use App\Auth\Credential\Domain\Scope;
use App\Auth\Credential\Domain\Scopes;
use App\Tests\Common\Factory\MotherFactory;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ClientMother
{
    public static function create(
        UuidInterface $id,
        array $grants,
        ClientCredentialParam $clientCredentialParam,
        Scopes $scopes,
        array $redirectUris = null,
        bool $active = true,
    ): Client {
        return Client::create(
            $id,
            $grants,
            $clientCredentialParam,
            $scopes,
            $redirectUris,
            $active
        );
    }

    public static function withIdentifier(
        string $identifier,
    ): Client {
        return self::create(
            Uuid::uuid7(),
            MotherFactory::random()->randomElements(Grant::cases()),
            ClientCredentialParamMother::withIdentifier($identifier),
            Scopes::fromArray([Scope::ALL->toPrimitive()]),
        );
    }

    public static function random(): Client
    {
        return self::create(
            Uuid::uuid7(),
            MotherFactory::random()->randomElements(Grant::cases()),
            ClientCredentialParamMother::random(),
            Scopes::fromArray([Scope::ALL->toPrimitive()]),
        );
    }
}
