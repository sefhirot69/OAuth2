<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Api;

use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class CreateCredentialController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var CreateClientRequestDto $requestDto */
        $requestDto = $this->validationRequest($request, CreateClientRequestDto::class);

        return new JsonResponse($this->command($requestDto->mapToCommand()));
    }

    protected function exceptions(): array
    {
        return [];
    }
}
