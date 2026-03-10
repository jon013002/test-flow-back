<?php

namespace App\Services;

use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\ValidateUserCredentialsAction;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function __construct(
        protected ValidateUserCredentialsAction $validateUserCredentialsAction,
        protected LogoutAction $logoutAction,
        protected UserRepositoryInterface $userRepository
    ) {}

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function validateCredentials(string $email, string $password)
    {
        $user = $this->validateUserCredentialsAction->execute($email, $password);
        $token = $user->createToken('auth-token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function getAuthenticatedUser(): User
    {
        return Auth::user() ?? abort(401, 'Unauthenticated.');
    }

    public function logout(): void
    {
        $this->logoutAction->execute();
    }
}
