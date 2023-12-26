<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Api;

use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GenerateTokenController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        return new Response();
    }

    protected function exceptions(): array
    {
        return [];
    }
}
