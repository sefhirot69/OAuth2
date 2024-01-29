<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Application\Command;

use App\Auth\Credential\Application\Command\CreateCredentialCommand;
use App\Tests\Common\Factory\MotherFactory;

final class CreateCredentialCommandMother
{
    public static function create(
        string $name,
        array $grants,
        array $scopes = [],
    ): CreateCredentialCommand {
        return CreateCredentialCommand::create(
            $name,
            $grants,
            $scopes
        );
    }

    public static function random(): CreateCredentialCommand
    {
        return self::create(
            MotherFactory::random()->company(),
            ['client_credentials'],
            ['all']
        );
    }
}
