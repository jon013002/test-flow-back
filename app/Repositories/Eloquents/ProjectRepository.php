<?php

namespace App\Repositories\Eloquents;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(
        protected Project $project,
    ) {}

    // 🚧 Workin on
    public function findAll(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return Project::query()
            ->when(
                $filters['name'] ?? null,
                fn($query, $name) =>
                $query->where('name', 'like', "%$name%")
            )
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data): Project
    {
        return $this->project->create($data);
    }

    public function findById(string $id): ?Project
    {
        return $this->project->findOrFail($id);
    }

    public function update(string $id, array $data): Project
    {
        $project = $this->findById($id);
        if (!$project) {
            throw new \Exception("Project not found");
        }

        $project->update($data);
        return $project;
    }

    public function delete(string $id): bool
    {
        $project = $this->findById($id);
        if (!$project) {
            return false;
        }
        return $project->delete();
    }
}
