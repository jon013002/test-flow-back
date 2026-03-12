<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function findAll(array $filters = [], int $perPage = 10): LengthAwarePaginator;
    public function create(array $data): Project;
    public function findById(string $id): ?Project;
    public function update(string $id, array $data): ?Project;
    public function delete(string $id): bool;
}
