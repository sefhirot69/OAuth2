<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Application\Command;

use App\Auth\Credential\Application\Command\AccessTokenCommandResponse;
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
        $accessTokenClass = $this->getMockBuilder(ClientCredentialAccessTokenMethod::class)
            ->onlyMethods(['getAccessToken'])
            ->getMock();
        $this->accessTokenFactory
            ->expects(self::once())
            ->method('method')
            ->with($command->getGrantType())
            ->willReturn($accessTokenClass);

        // THEN

        $handler = new GenerateTokenCommandHandler($this->accessTokenFactory);
        $result  = $handler($command);

        self::assertInstanceOf(AccessTokenCommandResponse::class, $result);
    }
}
