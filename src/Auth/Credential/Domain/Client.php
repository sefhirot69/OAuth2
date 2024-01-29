<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\UuidInterface;

final class Client extends AggregateRoot
{
    public function __construct(
        private UuidInterface $id,
        private readonly array $grants, // TODO pasar a una coleccion
        private readonly ClientCredentialParam $credentials,
        private readonly Scopes $scopes,
        private readonly ?array $redirectUris = null,
        private readonly bool $active = true,
    ) {
    }

    public static function create(
        UuidInterface $id,
        array $grants,
        ClientCredentialParam $credentials,
        Scopes $scopes,
        array $redirectUris = null,
        bool $active = true,
    ): self {
        return new self(
            $id,
            $grants,
            $credentials,
            $scopes,
            $redirectUris,
            $active
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCredentials(): ClientCredentialParam
    {
        return $this->credentials;
    }

    public function getIdentifier(): string
    {
        return $this->getCredentials()->getIdentifier();
    }

    public function getSecret(): string
    {
        return $this->getCredentials()->getSecret();
    }

    public function getName(): string
    {
        return $this->getCredentials()->getName();
    }

    /**
     * @return array<int, Grant>
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * @return array<int, Scope>
     */
    public function getScopes(): array
    {
        return $this->scopes->getItems();
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getRedirectUris(): ?array
    {
        return $this->redirectUris;
    }
}
