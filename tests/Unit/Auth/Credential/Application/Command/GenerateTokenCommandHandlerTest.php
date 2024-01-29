<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Application\Command;

use App\Auth\Authorization\Application\Command\AccessTokenCommandResponse;
use App\Auth\Authorization\Application\Command\GenerateTokenCommandHandler;
use App\Auth\Authorization\Domain\Factory\AccessTokenFactory;
use App\Auth\Authorization\Domain\Factory\ClientCredentialAccessTokenMethod;
use App\Auth\Credential\Domain\ClientFindRepository;
use App\Auth\Credential\Domain\ClientIdentifier;
use App\Tests\Unit\Auth\Credential\Domain\ClientMother;
use App\Tests\Unit\Auth\Credential\Infrastructure\Api\Dto\GenerateTokenRequestDtoMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GenerateTokenCommandHandlerTest extends TestCase
{
    private AccessTokenFactory|MockObject $accessTokenFactory;
    private MockObject|ClientFindRepository $clientFind;

    public function setUp(): void
    {
        $this->accessTokenFactory = $this->createMock(AccessTokenFactory::class);
        $this->clientFind         = $this->createMock(ClientFindRepository::class);
    }

    /** @test */
    public function shouldGenerateAccessToken(): void
    {
        // GIVEN

        $dto            = GenerateTokenRequestDtoMother::random();
        $command        = $dto->toCommand();
        $clientExpected = ClientMother::withIdentifier(
            $command->getClientId()
        );

        // WHEN

        $this->clientFind
            ->expects(self::once())
            ->method('findByIdentifier')
            ->with(ClientIdentifier::fromString($command->getClientId()))
            ->willReturn($clientExpected);

        $accessTokenClass = $this->getMockBuilder(ClientCredentialAccessTokenMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAccessToken'])
            ->getMock();
        $this->accessTokenFactory
            ->expects(self::once())
            ->method('method')
            ->with($command->getGrantType())
            ->willReturn($accessTokenClass);

        // THEN

        $handler = new GenerateTokenCommandHandler(
            $this->accessTokenFactory,
            $this->clientFind
        );
        $result = $handler($command);

        self::assertInstanceOf(AccessTokenCommandResponse::class, $result);
    }

    /** @test */
    public function shouldThrowErrorWhenNotFoundClient(): void
    {
        // GIVEN

        $dto     = GenerateTokenRequestDtoMother::random();
        $command = $dto->toCommand();

        // WHEN

        $this->clientFind
            ->expects(self::once())
            ->method('findByIdentifier')
            ->with(ClientIdentifier::fromString($command->getClientId()))
            ->willReturn(null);

        // THEN

        $handler = new GenerateTokenCommandHandler(
            $this->accessTokenFactory,
            $this->clientFind
        );

        $this->expectException(\InvalidArgumentException::class);
        $handler($command);
    }
}
