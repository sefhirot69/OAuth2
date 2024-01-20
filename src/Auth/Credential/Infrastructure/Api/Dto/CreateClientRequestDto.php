<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Api\Dto;

use App\Auth\Credential\Application\Command\CreateCredentialCommand;
use App\Shared\Api\RequestDto;

final class CreateClientRequestDto implements RequestDto
{
    public function __construct(
        private readonly string $name,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function mapToCommand(): CreateCredentialCommand
    {
        return CreateCredentialCommand::fromName($this->getName());
    }
}
