<?php

namespace App\Actions\Modules;

use App\Repositories\Interfaces\ModuleRepositoryInterface;

class DeleteModuleAction
{
    public function __construct(
        protected ModuleRepositoryInterface $moduleRepo,
    ) {}

    public function execute(string $id): bool
    {
        $this->moduleRepo->findById($id);
        return $this->moduleRepo->delete($id);
    }
}
