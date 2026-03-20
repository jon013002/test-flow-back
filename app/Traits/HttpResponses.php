<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

trait HTTPResponses
{
    protected function success(
        mixed $payload,
        string $method = 'GET',
        string $message = 'Success',
        int $status = Response::HTTP_OK,
    ) {
        $resolvedPayload = $this->resolvePayload($payload);

        return response([
            'http' => $this->buildHttpMeta($method, $message, $status),
            'data' => $resolvedPayload['data'],
        ], $status);
    }

    protected function failure(
        string $method = 'GET',
        string $message = 'Error',
        int $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $errors = [],
    ) {
        $response = [
            'http' => $this->buildHttpMeta($method, $message, $status),
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response($response, $status);
    }

    protected function resolvePayload(mixed $payload): array
    {
        if (!$payload instanceof JsonResource) {
            return [
                'data' => $payload,
            ];
        }

        $resourceResponse = $payload->response()->getData(true);

        return [
            'data' => $resourceResponse['data'] ?? $resourceResponse,
        ];
    }

    protected function buildHttpMeta(
        string $method,
        string $message,
        int $status,
    ): array {
        return [
            'method' => $method,
            'status' => $status,
            'message' => $message,
        ];
    }
}
