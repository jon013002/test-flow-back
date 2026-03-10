<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function findByEmail(string $email): ?User;
    public function existsByEmail(string $email): bool;
    public function findById(int $id): ?User;
    public function update(int $id, array $data): User;
    public function findAll(array $filters, int $perPage): LengthAwarePaginator;
}
