<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Api\Dto;

use App\Auth\Credential\Application\Command\GenerateTokenCommand;
use App\Shared\Api\RequestDto;
use Symfony\Component\Validator\Constraints as Assert;

final class GenerateTokenRequestDto implements RequestDto, \JsonSerializable
{
    public function __construct(
        #[Assert\Choice(choices: ['client_credentials', 'password', 'refresh_token'])]
        private readonly string $grantType,
        #[Assert\NotBlank]
        private readonly string $clientId,
        #[Assert\NotBlank]
        private readonly string $clientSecret,
    ) {
    }

    public function getGrantType(): string
    {
        return $this->grantType;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function jsonSerialize(): array
    {
        return [
            'grantType'    => $this->grantType,
            'clientId'     => $this->clientId,
            'clientSecret' => $this->clientSecret,
        ];
    }

    public function toCommand(): GenerateTokenCommand
    {
        return new GenerateTokenCommand(
            $this->getGrantType(),
            $this->getClientId(),
            $this->getClientSecret(),
        );
    }
}
