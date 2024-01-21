<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\ClientCredentialParam;
use App\Auth\Credential\Domain\ClientName;
use App\Tests\Common\MotherFactory;

final class ClientCredentialParamMother
{
    public static function createFromName(
        ClientName $name,
    ): ClientCredentialParam {
        return ClientCredentialParam::createFromName($name);
    }

    public static function withIdentifier(
        string $identifier,
    ): ClientCredentialParam {
        return new ClientCredentialParam(
            ClientIdentifierMother::create($identifier),
            ClientName::fromString(MotherFactory::random()->name()),
            ClientSecretMother::random(),
        );
    }

    public static function random(): ClientCredentialParam
    {
        return self::createFromName(ClientNameMother::random());
    }
}
