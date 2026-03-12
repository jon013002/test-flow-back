<?php

namespace App\Actions\Projects;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class CreateProjectAction
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepo,
    ) {}

    public function execute(array $data): Project
    {
        return $this->projectRepo->create($data);
    }
}
