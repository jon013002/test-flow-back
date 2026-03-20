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
        return $this->success(
            new UserResource($result),
            'POST',
            'User registered successfully',
            Response::HTTP_CREATED,
        );
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->validateCredentials($request->email, $request->password);
        return $this->success(
            new UserResource($result),
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
