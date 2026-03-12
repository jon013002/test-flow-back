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

    public static function fromStoreRequest(StoreModuleRequest $storeProjectRequest): self
    {
        return new self(
            projectId: $storeProjectRequest->validated('project_id'),
            name: $storeProjectRequest->validated('name'),
            result: $storeProjectRequest->validated('result'),
            description: $storeProjectRequest->validated('description'),
        );
    }

    public static function fromUpdateRequest(UpdateModuleRequest $updateProjectRequest)
    {
        return new self(
            projectId: $updateProjectRequest->validated('project_id'),
            name: $updateProjectRequest->validated('name'),
            result: $updateProjectRequest->validated('result'),
            description: $updateProjectRequest->validated('description'),
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
