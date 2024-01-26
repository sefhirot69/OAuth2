<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class RefreshToken extends AggregateRoot
{
    private function __construct(
        private readonly UuidInterface $id,
        private readonly Token $token,
        private readonly ExpiresIn $expiresIn,
    ) {
    }

    public static function create(
        Token $token,
    ): self {
        return new self(
            Uuid::uuid7(),
            $token,
            ExpiresIn::makeExpiresInRefreshToken(),
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getToken(): Token
    {
        return $this->token;
    }

    public function getExpiresIn(): \DateTimeImmutable
    {
        return $this->expiresIn->value();
    }

    /**
     * @return string
     */
    public function getClientIdentifier(): string
    {
        return $this->token->getClientIdentifier();
    }

    public function getScopes(): array
    {
        return $this->token->getScopes();
    }
}
