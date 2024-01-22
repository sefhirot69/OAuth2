<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

use App\Auth\Credential\Application\Service\AccessTokenFactory;
use App\Auth\Credential\Domain\ClientFindRepository;
use App\Auth\Credential\Domain\ClientIdentifier;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class GenerateTokenCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly AccessTokenFactory $accessTokenFactory,
        private readonly ClientFindRepository $clientFindRepository,
    ) {
    }

    public function __invoke(GenerateTokenCommand $command): AccessTokenCommandResponse
    {
        $client = $this->clientFindRepository->findByIdentifier(
            ClientIdentifier::fromString(
                $command->getClientId()
            )
        );

        if (null === $client) {
            throw new \InvalidArgumentException('Client not found');
        }

        $accessToken = $this->accessTokenFactory->method($command->getGrantType())->getAccessToken(
            $command,
            $client
        );

        return AccessTokenCommandResponse::fromAccessToken($accessToken);
    }
}
