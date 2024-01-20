<?php

declare(strict_types=1);

namespace App\Tests\Common\Auth\Credential\Infrastructure\Api\Dto;

use App\Auth\Credential\Domain\Grant;
use App\Auth\Credential\Infrastructure\Api\Dto\GenerateTokenRequestDto;
use App\Tests\Common\MotherFactory;

final class GenerateTokenRequestDtoMother
{
    public static function create(
        string $grantType,
        string $clientId,
        string $clientSecret,
    ): GenerateTokenRequestDto {
        return new GenerateTokenRequestDto(
            $grantType,
            $clientId,
            $clientSecret,
        );
    }

    public static function random(): GenerateTokenRequestDto
    {
        return self::create(
            MotherFactory::random()->randomElement(Grant::toValues()),
            MotherFactory::random()->uuid(),
            MotherFactory::random()->uuid(),
        );
    }

    public static function clientCredential(): GenerateTokenRequestDto
    {
        return self::create(
            Grant::CLIENT_CREDENTIALS->value,
            MotherFactory::random()->uuid(),
            MotherFactory::random()->uuid(),
        );
    }
}
