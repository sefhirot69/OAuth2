<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain;

interface RefreshTokenSaveRepository
{
    public function save(RefreshToken $token): void;
}
