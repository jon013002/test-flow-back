<?php

namespace App\Services;

use App\Actions\Modules\CreateModuleAction;
use App\Actions\Modules\DeleteModuleAction;
use App\Actions\Modules\UpdateModuleAction;

use App\Repositories\Interfaces\ModuleRepositoryInterface;

class ModuleService
{
    public function __construct(
        protected CreateModuleAction $createModuleAction,
        protected DeleteModuleAction $deleteModuleAction,
        protected UpdateModuleAction $updateModuleAction,
        protected ModuleRepositoryInterface $moduleRepository,
    ) {}

    public function list(array $filters = [], int $perPage = 10)
    {
        return $this->moduleRepository->findAll($filters, $perPage);
    }

    public function create(array $data)
    {
        return $this->createModuleAction->execute($data);
    }

    public function show(string $id)
    {
        return $this->moduleRepository->findById($id);
    }

    public function update(string $id, array $data)
    {
        return $this->updateModuleAction->execute($id, $data);
    }

    public function delete(string $id)
    {
        return $this->deleteModuleAction->execute($id);
    }
}
