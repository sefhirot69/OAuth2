<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Infrastructure\Api;

use App\Auth\Authorization\Infrastructure\Api\Dto\GenerateTokenRequestDto;
use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class GenerateTokenController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var GenerateTokenRequestDto $requestDto */
        $requestDto = $this->validationRequest($request, GenerateTokenRequestDto::class);

        $accessToken = $this->command(
            $requestDto->toCommand()
        );

        return new JsonResponse(
            $accessToken,
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [
            ValidationFailedException::class => Response::HTTP_BAD_REQUEST,
        ];
    }
}
