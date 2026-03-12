<?php

namespace App\Actions\Modules;

use App\Models\Module;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class CreateModuleAction
{
    public function __construct(
        private ModuleRepositoryInterface $moduleRepo,
    ) {}

    public function execute(array $data): Module
    {
        return $this->moduleRepo->create($data);
    }
}
