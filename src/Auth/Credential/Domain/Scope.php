<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

enum Scope: string
{
    case ALL = 'all';

    public function toPrimitive(): string
    {
        return $this->value;
    }
}
