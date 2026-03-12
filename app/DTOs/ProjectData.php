<?php

namespace App\DTOs;

use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;

class ProjectData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description
    )
    {}

    public static function fromStoreRequest(StoreProjectRequest $storeProjectRequest){
        return new self(
            name: $storeProjectRequest->validated('name'),
            description: $storeProjectRequest->validated('description')
        );
    }

    public static function fromUpdateRequest(UpdateProjectRequest $updateProjectRequest){
        return new self(
            name: $updateProjectRequest->validated('name'),
            description: $updateProjectRequest->validated('description')
        );
    }

    public function toArray(){
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
