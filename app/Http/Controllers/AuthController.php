<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use App\Http\Resources\UserResource;

use App\Services\AuthService;
use App\Traits\HTTPResponses;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use HTTPResponses;

    public function __construct(
        protected AuthService $authService,
    ) {}

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());
        $resource = (new UserResource($result['user']))
            ->additional([
                'meta' => [
                    'token_type' => 'Bearer',
                    'token' => $result['token'],
                ]
        ]);

        return $this->success(
            $resource,
            'POST',
            'User registered successfully',
            Response::HTTP_CREATED,
        );
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->validateCredentials($request->email, $request->password);
        $resource = (new UserResource($result['user']))
            ->additional([
                'meta' => [
                    'token' => $result['token'],
                ]
        ]);

        return $this->success(
            $resource,
            'POST',
            'Logged in successfully',
            Response::HTTP_OK,
        );
    }

    public function getUser()
    {
        $user = $this->authService->getAuthenticatedUser();
        return $this->success(
            new UserResource($user),
            'GET',
            'Information obtained correctly',
            Response::HTTP_OK,
        );
    }

    public function logout()
    {
        $this->authService->logout();
        return $this->success(
            [],
            'POST',
            'Logged out successfully',
            Response::HTTP_OK,
        );
    }
}
