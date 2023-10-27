<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\UuidInterface;

final class Client extends AggregateRoot
{
    public function __construct(
        private UuidInterface $id,
        private readonly array $grants,
        private readonly ClientCredentialsParam $credentials,
        private readonly array $scopes,
        private readonly ?array $redirectUris = null,
        private readonly bool $active = true,
    ) {
    }

    public static function create(
        UuidInterface $id,
        array $grants,
        ClientCredentialsParam $credentials,
        array $scopes,
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

    public function getCredentials(): ClientCredentialsParam
    {
        return $this->credentials;
    }

    public function getIdentifier(): ClientIdentifier
    {
        return $this->getCredentials()->getIdentifier();
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
        return $this->scopes;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function ensureIsActive(): bool
    {
        if (!$this->isActive()) {
            throw ClientOperationDeniedException::inactive($this->getIdentifier());
        }

        return true;
    }

    public function ensureGrantSupported(Grant $grant): bool
    {
        if (!$this->isGrantSupported($grant)) {
            throw ClientOperationDeniedException::grantNotSupported($this->getIdentifier(), $grant);
        }

        return true;
    }

    public function isGrantSupported(Grant $grant): bool
    {
        $grants = $this->getGrants();

        if (empty($grants)) {
            return false;
        }

        return in_array($grant, $grants, true);
    }

    public function getRedirectUris(): ?array
    {
        return $this->redirectUris;
    }
}
