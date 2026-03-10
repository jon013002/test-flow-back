<?php

namespace App\Support;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApiExceptionResponder
{
    public static function make(Throwable $e, Request $request): array
    {
        $resolved = self::resolve($e);

        return [
            'http' => [
                'status' => $resolved['status'],
                'message' => $resolved['message'],
                'method' => $request->getMethod(),
            ],
            'errors' => $resolved['errors'],
        ];
    }

    protected static function resolve(Throwable $e): array
    {
        if ($e instanceof ValidationException) {
            return self::validationError($e);
        }

        if ($e instanceof AuthenticationException) {
            return self::unauthenticated();
        }

        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            return self::notFound();
        }

        if ($e instanceof UnprocessableEntityHttpException) {
            return self::unprocessableEntity($e);
        }

        if ($e instanceof BadRequestHttpException) {
            return self::badRequest($e);
        }

        if ($e instanceof HttpException) {
            return self::httpException($e);
        }

        return self::serverError($e);
    }

    protected static function validationError(ValidationException $e): array
    {
        return [
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ];
    }

    protected static function unauthenticated(): array
    {
        return [
            'status' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Unauthenticated.',
            'errors' => [],
        ];
    }

    protected static function notFound(): array
    {
        return [
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Resource not found.',
            'errors' => [],
        ];
    }

    protected static function unprocessableEntity(UnprocessableEntityHttpException $e): array
    {
        return [
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $e->getMessage() ?: 'Unprocessable entity.',
            'errors' => [],
        ];
    }

    protected static function badRequest(BadRequestHttpException $e): array
    {
        return [
            'status' => Response::HTTP_BAD_REQUEST,
            'message' => $e->getMessage() ?: 'Bad request.',
            'errors' => [],
        ];
    }

    protected static function httpException(HttpException $e): array
    {
        return [
            'status' => $e->getStatusCode(),
            'message' => $e->getMessage() ?: 'HTTP error.',
            'errors' => [],
        ];
    }

    protected static function serverError(Throwable $e): array
    {
        return [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => 'An unexpected error occurred.',
            'errors' => app()->isLocal()
                ? ['exception' => [$e->getMessage()]]
                : [],
        ];
    }
}
