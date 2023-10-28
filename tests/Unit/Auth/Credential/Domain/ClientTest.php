<?php

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\Client;
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
            $clientExpected->getGrants(),
            $clientExpected->getCredentials(),
            $clientExpected->getScopes()
        );

        // THEN

        self::assertEquals($clientExpected, $client);
        self::assertTrue($client->isActive());
    }
}
