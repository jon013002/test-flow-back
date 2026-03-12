<?php

namespace App\Repositories\Interfaces;

use App\Models\Module;
use Illuminate\Pagination\LengthAwarePaginator;

interface ModuleRepositoryInterface
{
    public function findAll(array $filters = [], int $perPage = 10): LengthAwarePaginator;
    public function create(array $data): Module;
    public function findById(string $id): ?Module;
    public function update(string $id, array $data): ?Module;
    public function delete(string $id): bool;
}
