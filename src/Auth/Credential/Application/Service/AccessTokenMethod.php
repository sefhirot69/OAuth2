<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Service;

use App\Auth\Credential\Domain\AccessToken;

interface AccessTokenMethod
{
    public function getAccessToken(): AccessToken;
}
