<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait SendsResponses
{
    protected function successResponse($data, int $status = JsonResponse::HTTP_OK): JsonResponse
    {
        return new JsonResponse($data, $status);
    }

    protected function emptyResponse(int $status = JsonResponse::HTTP_NO_CONTENT): JsonResponse
    {
        return new JsonResponse(null, $status);
    }

    protected function errorResponse(string $message, string $code, int $status = JsonResponse::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'error' => [
                'http_code' => $code,
                'message' => $message,
            ],
        ], $status);
    }
}
