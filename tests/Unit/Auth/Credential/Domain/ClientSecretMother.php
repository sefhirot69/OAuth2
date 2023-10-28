<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\ClientSecret;
use App\Tests\Common\MotherFactory;

final class ClientSecretMother
{
    public static function create(string $value): ClientSecret
    {
        return ClientSecret::fromString($value);
    }

    public static function random(): ClientSecret
    {
        return self::create(MotherFactory::random()->md5());
    }
}
