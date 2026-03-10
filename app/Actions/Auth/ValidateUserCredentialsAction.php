<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ValidateUserCredentialsAction
{
    public function __construct(
        private UserRepositoryInterface $userRepo
    ) {}

    public function execute(string $email, string $password): User
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Exception('Invalid credentials');
        }

        return $user;
    }
}
