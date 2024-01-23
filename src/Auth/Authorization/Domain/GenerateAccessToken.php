<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain;

interface GenerateAccessToken
{
    public function generateAccessToken(Token $token): AccessToken;
}
