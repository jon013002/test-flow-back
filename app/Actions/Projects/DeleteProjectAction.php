<?php

namespace App\Actions\Projects;

use App\Repositories\Interfaces\ProjectRepositoryInterface;

class DeleteProjectAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ProjectRepositoryInterface $projectRepo,
    ) {}

    public function execute(string $id): bool
    {
        $this->projectRepo->findById($id);
        return $this->projectRepo->delete($id);
    }
}
