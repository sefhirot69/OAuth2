<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Service;

use App\Auth\Credential\Application\Command\GenerateTokenCommand;
use App\Auth\Credential\Domain\AccessToken;
use App\Auth\Credential\Domain\Client;

interface AccessTokenMethod
{
    public function getAccessToken(GenerateTokenCommand $command, Client $client): AccessToken;
}
