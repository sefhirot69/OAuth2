<?php

declare(strict_types=1);

namespace App\Tests\Functional\Auth\Credential\Infrastructure\Api;

use App\Tests\Common\Auth\Credential\Infrastructure\Api\Dto\GenerateTokenRequestDtoMother;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GenerateTokenControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /** @test */
    public function itShouldReturnAccessTokenWithGrantTypeClientCredential(): void
    {
        // GIVEN

        $credentials = GenerateTokenRequestDtoMother::clientCredential();

        // WHEN

        $this->client->request(
            'POST',
            'api/auth/tokens',
            [],
            [],
            [],
            json_encode($credentials, JSON_THROW_ON_ERROR)
        );

        $response = $this->client->getResponse();

        // THEN

        self::assertResponseIsSuccessful();

        /*
         * TODO: Check response body
         * access_token
         * token_type
         * expires_in
         */
    }
}
