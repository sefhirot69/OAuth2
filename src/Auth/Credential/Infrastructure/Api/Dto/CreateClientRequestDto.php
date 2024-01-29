<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Api\Dto;

use App\Auth\Credential\Application\Command\CreateCredentialCommand;
use App\Shared\Api\RequestDto;

final class CreateClientRequestDto implements RequestDto
{
    public function __construct(
        private readonly string $name,
        private readonly array $grants,
        private readonly array $scopes = ['all'],
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGrants(): array
    {
        return $this->grants;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function mapToCommand(): CreateCredentialCommand
    {
        return CreateCredentialCommand::create(
            $this->getName(),
            $this->getGrants(),
            $this->getScopes(),
        );
    }
}
