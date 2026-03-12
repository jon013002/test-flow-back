<?php

namespace App\Actions\Projects;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class UpdateProjectAction
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepo,
    ) {}

    public function execute(string $id, array $data): ?Project
    {
        $this->projectRepo->findById($id);
        return $this->projectRepo->update($id, $data);
    }
}
