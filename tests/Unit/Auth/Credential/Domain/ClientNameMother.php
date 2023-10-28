<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\ClientName;
use App\Tests\Common\MotherFactory;

final class ClientNameMother
{
    public static function create(string $value): ClientName
    {
        return ClientName::fromString($value);
    }

    public static function random(): ClientName
    {
        return self::create(MotherFactory::random()->company());
    }
}
