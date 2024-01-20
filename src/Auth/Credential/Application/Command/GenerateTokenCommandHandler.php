<?php

declare(strict_types=1);

namespace App\Auth\Credential\Application\Command;

use App\Auth\Credential\Application\Service\AccessTokenFactory;

final class GenerateTokenCommandHandler
{
    public function __construct(
        private readonly AccessTokenFactory $accessTokenFactory
    ) {
    }

    public function __invoke(GenerateTokenCommand $command): void
    {
        $this->accessTokenFactory->method($command->getGrantType());
    }
}
