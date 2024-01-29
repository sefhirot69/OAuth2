<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Application\Command;

use App\Auth\Credential\Application\Command\CreateCredentialCommand;
use App\Tests\Common\Factory\MotherFactory;

final class CreateCredentialCommandMother
{
    public static function fromName(
        string $name,
    ): CreateCredentialCommand {
        return CreateCredentialCommand::fromName($name);
    }

    public static function create(
        string $name,
        array $scopes = [],
    ): CreateCredentialCommand {
        return CreateCredentialCommand::create($name, $scopes);
    }

    public static function randomName(): CreateCredentialCommand
    {
        return self::fromName(MotherFactory::random()->company());
    }

    public static function random(): CreateCredentialCommand
    {
        return self::create(
            MotherFactory::random()->company(),
            ['all']
        );
    }
}
