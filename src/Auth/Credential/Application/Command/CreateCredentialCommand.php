<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final class CreateCredentialCommand implements Command
{
    private function __construct(
        private readonly string $name,
        private readonly array $scopes = [],
    ) {
    }

    public static function create(
        string $name,
        array $scopes = [],
    ): self {
        return new self(
            $name,
            $scopes
        );
    }

    public static function fromName(string $name): self
    {
        return new self($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }
}
