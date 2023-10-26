<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

enum Grant: string
{
    case PASSWORD           = 'password';
    case CLIENT_CREDENTIALS = 'client_credentials';
    case REFRESH_TOKEN      = 'refresh_token';
}
