<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Persistence\Repository;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\ClientSaveRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;

final class DoctrineClientSaveRepository extends DoctrineRepository implements ClientSaveRepository
{
    public function save(Client $client): void
    {
        $this->persist($client);
    }
}
