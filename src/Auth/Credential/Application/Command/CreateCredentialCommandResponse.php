<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

use App\Auth\Credential\Domain\ClientCredentialParam;
use App\Shared\Domain\Bus\Command\CommandResponse;

final class CreateCredentialCommandResponse implements CommandResponse, \JsonSerializable
{
    private function __construct(
        private readonly string $name,
        private readonly string $identifier,
        private readonly string $secret,
    ) {
    }

    public static function fromCredential(ClientCredentialParam $clientCredential): self
    {
        return new self(
            $clientCredential->getName(),
            $clientCredential->getIdentifier(),
            $clientCredential->getSecret()
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
