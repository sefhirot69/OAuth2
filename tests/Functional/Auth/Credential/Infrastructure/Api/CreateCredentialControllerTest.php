<?php

namespace App\Tests\Functional\Auth\Credential\Infrastructure\Api;

use App\Tests\Common\Factory\MotherFactory;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateCredentialControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /** @test */
    public function itShouldReturnAnOk(): void
    {
        // GIVEN

        // WHEN

        $this->client
            ->request(
                'POST',
                'api/auth/credentials',
                [],
                [],
                [],
                json_encode(
                    [
                        'name'   => MotherFactory::random()->company(),
                        'grants' => ['client_credentials'],
                        'scopes' => ['all'],
                    ],
                    true,
                    JSON_THROW_ON_ERROR
                )
            );

        $response = $this->client->getResponse();

        // THEN

        self::assertResponseIsSuccessful();
    }
}
