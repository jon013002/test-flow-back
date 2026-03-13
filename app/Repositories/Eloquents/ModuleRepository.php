<?php

namespace App\Repositories\Eloquents;

use App\Models\Module;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ModuleRepository implements ModuleRepositoryInterface
{
    public function __construct(
        protected Module $module,
    ) {}

    // 🚧 Workin on
    public function findAll(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return Module::query()
            ->when(
                $filters['name'] ?? null,
                fn($query, $name) =>
                $query->where('name', 'like', "%$name%")
            )
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data): Module
    {
        return $this->module->create($data);
    }

    public function findById(string $id): ?Module
    {
        return $this->module->findOrFail($id);
    }

    public function update(string $id, array $data): Module
    {
        $module = $this->findById($id);
        if (!$module) {
            throw new \Exception("Module not found");
        }

        $module->update($data);
        return $module;
    }

    public function delete(string $id): bool
    {
        $module = $this->findById($id);
        if (!$module) {
            return false;
        }
        return $module->delete();
    }
}
