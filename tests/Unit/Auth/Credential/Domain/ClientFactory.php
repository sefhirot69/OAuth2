<?php

declare(strict_types=1);

namespace App\Tests\Unit\Auth\Credential\Domain;

use App\Auth\Credential\Domain\Client;
use App\Auth\Credential\Domain\ClientCredentialParam;
use App\Auth\Credential\Domain\Grant;
use App\Tests\Common\Factory\AbstractEntityFactory;
use Ramsey\Uuid\Uuid;

final class ClientFactory extends AbstractEntityFactory
{
    /**
     * @throws \Exception
     */
    protected function setDefaults(): void
    {
        $this->setAttributeSet([
            'id'          => Uuid::uuid7(),
            'grants'      => [Grant::CLIENT_CREDENTIALS],
            'credentials' => ClientCredentialParam::createFromName(
                ClientNameMother::random()
            ),
            'scopes'       => [],
            'redirectUris' => null,
        ]);
    }

    protected static function getClass(): string
    {
        return Client::class;
    }
}
