<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final class CreateCredentialCommand implements Command
{
    private function __construct(
        private readonly string $name,
    ) {
    }

    public static function fromName(string $name): self
    {
        return new self($name);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
