<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Infrastructure\Persistence\Repository;

use App\Auth\Authorization\Domain\Token;
use App\Auth\Authorization\Domain\TokenSaveRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;

final class DoctrineTokenSaveRepository extends DoctrineRepository implements TokenSaveRepository
{
    public function save(Token $token): void
    {
        $this->persist($token);
    }
}
