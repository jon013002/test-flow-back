<?php

namespace App\Services;

use App\Actions\Projects\CreateProjectAction;
use App\Actions\Projects\DeleteProjectAction;
use App\Actions\Projects\UpdateProjectAction;

use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectService
{

    public function __construct(
        protected CreateProjectAction $createProjectAction,
        protected DeleteProjectAction $deleteProjectAction,
        protected UpdateProjectAction $updateProjectAction,
        protected ProjectRepositoryInterface $projectRepository,
    ) {}

    public function list(array $filters = [], int $perPage = 10)
    {
        return $this->projectRepository->findAll($filters, $perPage);
    }

    public function create(array $data)
    {
        return $this->createProjectAction->execute($data);
    }

    public function show(string $id)
    {
        return $this->projectRepository->findById($id);
    }

    public function update(string $id, array $data)
    {
        return $this->updateProjectAction->execute($id, $data);
    }

    public function delete(string $id)
    {
        return $this->deleteProjectAction->execute($id);
    }
}
