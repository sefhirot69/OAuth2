<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Api;

use App\Auth\Credential\Infrastructure\Api\Dto\GenerateTokenRequestDto;
use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class GenerateTokenController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        /** @var GenerateTokenRequestDto $requestDto */
        $requestDto = $this->validationRequest($request, GenerateTokenRequestDto::class);

        return new Response();
    }

    protected function exceptions(): array
    {
        return [
            ValidationFailedException::class => Response::HTTP_BAD_REQUEST,
        ];
    }
}
