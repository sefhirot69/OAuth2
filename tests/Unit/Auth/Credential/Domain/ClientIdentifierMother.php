<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\ClientIdentifier;
use App\Tests\Common\MotherFactory;

final class ClientIdentifierMother
{
    public static function create(string $value): ClientIdentifier
    {
        return ClientIdentifier::fromString($value);
    }

    public static function random(): ClientIdentifier
    {
        return self::create(MotherFactory::random()->md5());
    }
}
