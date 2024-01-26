<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\Scope;
use App\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Token extends AggregateRoot
{
    private function __construct(
        private readonly UuidInterface $id,
        private readonly Client $client,
        private readonly ExpiresIn $expiresIn,
    ) {
    }

    public static function create(
        Client $client,
    ): self {
        return new self(
            Uuid::uuid7(),
            $client,
            ExpiresIn::makeExpiresInToken(),
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getExpiresIn(): \DateTimeImmutable
    {
        return $this->expiresIn->value();
    }

    public function getClientIdentifier(): string
    {
        return $this->client->getIdentifier();
    }

    public function getScopes(): array
    {
        return array_map(
            fn (Scope $scope) => $scope->value,
            $this->client->getScopes()
        );
    }
}
