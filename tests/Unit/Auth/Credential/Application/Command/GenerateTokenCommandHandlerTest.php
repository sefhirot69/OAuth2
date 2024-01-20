<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Application\Command;

use App\Auth\Credential\Application\Command\GenerateTokenCommandHandler;
use App\Auth\Credential\Application\Service\AccessTokenFactory;
use App\Auth\Credential\Application\Service\ClientCredentialAccessTokenMethod;
use App\Tests\Common\Auth\Credential\Infrastructure\Api\Dto\GenerateTokenRequestDtoMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GenerateTokenCommandHandlerTest extends TestCase
{
    private AccessTokenFactory|MockObject $accessTokenFactory;

    public function setUp(): void
    {
        $this->accessTokenFactory = $this->createMock(AccessTokenFactory::class);
    }

    public function testShouldGenerateToken(): void
    {
        // GIVEN

        $dto     = GenerateTokenRequestDtoMother::random();
        $command = $dto->toCommand();

        // WHEN

        $this->accessTokenFactory
            ->expects(self::once())
            ->method('method')
            ->willReturn(new ClientCredentialAccessTokenMethod());

        // THEN

        $handler = new GenerateTokenCommandHandler($this->accessTokenFactory);
        $handler($command);
    }
}
