<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\ClientCredentialParam;
use App\Auth\Credential\Domain\ClientName;
use App\Auth\Credential\Domain\ClientSaveRepository;
use App\Auth\Credential\Domain\Grants;
use App\Auth\Credential\Domain\Scopes;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Command\CommandResponse;
use Ramsey\Uuid\Uuid;

final class CreateCredentialCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly ClientSaveRepository $clientSaveRepository
    ) {
    }

    public function __invoke(CreateCredentialCommand $command): CommandResponse
    {
        $name = $command->getName();

        $client = Client::create(
            Uuid::uuid7(),
            Grants::fromArray(
                $command->getGrants()
            ),
            ClientCredentialParam::createFromName(
                ClientName::fromString($name)
            ),
            Scopes::fromArray(
                $command->getScopes()
            )
        );

        $this->clientSaveRepository->save($client);

        return CreateCredentialCommandResponse::fromCredential($client->getCredentials());
    }
}
