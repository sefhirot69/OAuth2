<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\UuidInterface;

final class Token extends AggregateRoot
{
    private function __construct(
        private readonly UuidInterface $id,
        private readonly Client $client,
        private readonly \DateTimeImmutable $expiresIn,
        private readonly array $scopes,
        private readonly bool $revoked,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Client $client,
        \DateTimeImmutable $expiresIn,
        array $scopes,
        bool $revoked,
    ): self {
        return new self(
            $id,
            $client,
            $expiresIn,
            $scopes,
            true,
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
        return $this->expiresIn;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function isRevoked(): bool
    {
        return $this->revoked;
    }
}
