<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Persistence\Repository;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\ClientFindRepository;
use App\Auth\Credential\Domain\ClientIdentifier;
use App\Auth\Credential\Domain\ClientSecret;
use App\Auth\Credential\Domain\Grant;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineClientFindRepository extends DoctrineRepository implements ClientFindRepository
{
    public function find(UuidInterface $id): ?Client
    {
        // TODO: Implement find() method.
    }

    public function findByIdentifier(ClientIdentifier $identifier): ?Client
    {
        return $this->repository(Client::class)->findOneBy([
            'credentials.identifier.value' => $identifier->value(),
        ]);
    }

    public function validateClient(ClientIdentifier $identifier, ClientSecret $secret, Grant $grant): bool
    {
        // TODO: Implement validateClient() method.
    }
}
