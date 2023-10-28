<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Application\Command;

use App\Auth\Credential\Application\Command\CreateCredentialCommandHandler;
use App\Auth\Credential\Application\Command\CreateCredentialCommandResponse;
use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\ClientSaveRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateCredentialCommandHandlerTest extends TestCase
{
    private MockObject|ClientSaveRepository $clientSaveRepository;

    protected function setUp(): void
    {
        $this->clientSaveRepository = $this->createMock(ClientSaveRepository::class);
    }

    /** @test */
    public function itShouldCreateClientCredentialForDefault(): void
    {
        // GIVEN

        $request = CreateCredentialCommandMother::randomName();

        // WHEN

        $this->clientSaveRepository
            ->expects(self::once())
            ->method('save')
            ->with(self::callback(
                static function (Client $client): bool {
                    self::assertTrue($client->isActive());
                    self::assertNotNull($client->getIdentifier());
                    self::assertNotNull($client->getName());
                    self::assertNotNull($client->getSecret());
                    self::assertNotNull($client->getIdentifier());
                    self::assertNotEmpty($client->getGrants());
                    self::assertNotEmpty($client->getScopes());

                    return true;
                }
            ));

        $commandHandler = new CreateCredentialCommandHandler(
            $this->clientSaveRepository
        );

        $result = ($commandHandler)($request);

        // THEN

        self::assertInstanceOf(CreateCredentialCommandResponse::class, $result);
    }
}
