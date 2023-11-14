<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Persistence\Repository;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\ClientSaveRepository;

final class DoctrineClientSaveRepository implements ClientSaveRepository
{
    public function save(Client $client): void
    {
        return;
    }
}
