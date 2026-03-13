<?php

namespace App\DTOs;

use App\Http\Requests\Modules\StoreModuleRequest;
use App\Http\Requests\Modules\UpdateModuleRequest;

class ModuleData
{
    public function __construct(
        public readonly string $projectId,
        public readonly string $name,
        public readonly string $result,
        public readonly ?string $description
    )
    {}

    public static function fromStoreRequest(StoreModuleRequest $storeModuleRequest): self
    {
        return new self(
            projectId: $storeModuleRequest->validated('project_id'),
            name: $storeModuleRequest->validated('name'),
            result: $storeModuleRequest->validated('result'),
            description: $storeModuleRequest->validated('description'),
        );
    }

    public static function fromUpdateRequest(UpdateModuleRequest $updateModuleRequest)
    {
        return new self(
            projectId: $updateModuleRequest->validated('project_id'),
            name: $updateModuleRequest->validated('name'),
            result: $updateModuleRequest->validated('result'),
            description: $updateModuleRequest->validated('description'),
        );
    }

    public function toArray(){
        return [
            'project_id' => $this->projectId,
            'name' => $this->name,
            'description' => $this->description,
            'result' => $this->result,
        ];
    }
}
