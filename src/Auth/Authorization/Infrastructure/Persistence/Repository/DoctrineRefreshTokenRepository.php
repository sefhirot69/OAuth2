<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Infrastructure\Persistence\Repository;

use App\Auth\Authorization\Domain\RefreshToken;
use App\Auth\Authorization\Domain\RefreshTokenSaveRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;

final class DoctrineRefreshTokenRepository extends DoctrineRepository implements RefreshTokenSaveRepository
{
    public function save(RefreshToken $token): void
    {
        $this->persist($token);
    }
}
