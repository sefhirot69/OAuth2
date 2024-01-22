<?php

declare(strict_types=1);

namespace App\Tests\Functional\Auth\Credential\Infrastructure\Api;

use App\Auth\Credential\Domain\Client;
use App\Tests\Unit\Auth\Credential\Domain\ClientFactory;
use App\Tests\Unit\Auth\Credential\Infrastructure\Api\Dto\GenerateTokenRequestDtoMother;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GenerateTokenControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $this->client        = self::createClient();
        $this->entityManager = self::getContainer()->get('doctrine.orm.entity_manager');
    }

    /** @test */
    public function itShouldReturnAccessTokenWithGrantTypeClientCredential(): void
    {
        // GIVEN
        $clientFactory = new ClientFactory($this->entityManager);
        /** @var Client $client */
        $client      = $clientFactory->create();
        $credentials = GenerateTokenRequestDtoMother::clientCredentialWithIdentifier($client->getIdentifier());

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
    }
}
