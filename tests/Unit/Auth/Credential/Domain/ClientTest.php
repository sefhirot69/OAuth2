<?php

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\Grants;
use App\Auth\Credential\Domain\Scopes;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function itShouldCanCreateClientAndRetrieveValues(): void
    {
        // GIVEN

        $clientExpected = ClientMother::random();

        // WHEN

        $client = Client::create(
            $clientExpected->getId(),
            Grants::create($clientExpected->getGrants()),
            $clientExpected->getCredentials(),
            Scopes::create($clientExpected->getScopes())
        );

        // THEN

        self::assertEquals($clientExpected, $client);
        self::assertTrue($client->isActive());
    }
}
