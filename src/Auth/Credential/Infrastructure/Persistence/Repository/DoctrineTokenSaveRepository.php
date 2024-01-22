<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Persistence\Repository;

use App\Auth\Credential\Domain\Token;
use App\Auth\Credential\Domain\TokenSaveRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;

final class DoctrineTokenSaveRepository extends DoctrineRepository implements TokenSaveRepository
{
    public function save(Token $token): void
    {
        return;
    }
}
