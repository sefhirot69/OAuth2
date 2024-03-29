<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain;

interface TokenSaveRepository
{
    public function save(Token $token): void;
}
