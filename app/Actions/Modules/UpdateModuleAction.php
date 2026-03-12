<?php

namespace App\Actions\Modules;

use App\Models\Module;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class UpdateModuleAction
{
    public function __construct(
        private ModuleRepositoryInterface $moduleRepo,
    ) {}

    public function execute(string $id, array $data): ?Module
    {
        $this->moduleRepo->findById($id);
        return $this->moduleRepo->update($id, $data);
    }
}
