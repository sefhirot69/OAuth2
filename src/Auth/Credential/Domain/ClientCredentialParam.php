<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

final class ClientCredentialParam
{
    public function __construct(
        private readonly ClientIdentifier $identifier,
        private readonly ClientName $name,
        private readonly ClientSecret $secret,
    ) {
    }

    public static function create(
        ClientIdentifier $identifier,
        ClientName $name,
        ClientSecret $secret,
    ): self {
        return new self(
            $identifier,
            $name,
            $secret,
        );
    }

    /**
     * @throws \Exception
     */
    public static function createFromName(
        ClientName $name,
    ): self {
        return new self(
            ClientIdentifier::generate(),
            $name,
            ClientSecret::generate(),
        );
    }

    public function getIdentifier(): ClientIdentifier
    {
        return $this->identifier;
    }

    public function getName(): ClientName
    {
        return $this->name;
    }

    public function getSecret(): ClientSecret
    {
        return $this->secret;
    }
}
