<?php

namespace App\Http\Controllers;


use App\DTOs\ProjectData;

use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;

use App\Http\Resources\ProjectResource;

use App\Models\Project;

use App\Services\ProjectService;
use App\Traits\HTTPResponses;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    use HTTPResponses;

    public function __construct(
        protected ProjectService $projectService
    ) {}

    public function index()
    {
        // 🚧 Work in on
    }

    public function store(StoreProjectRequest $request)
    {
        $data = ProjectData::fromStoreRequest($request);
        $project = $this->projectService->create($data->toArray());

        return $this->success(
            new ProjectResource($project),
            'POST',
            'Project registered successfully',
            Response::HTTP_CREATED,
        );
    }

    public function show(Project $project)
    {
        $project = $this->projectService->show($project->id);

        return $this->success(
            new ProjectResource($project),
            'GET',
            'Project retrieved successfully',
            Response::HTTP_OK,
        );
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = ProjectData::fromUpdateRequest($request);
        $project = $this->projectService->update($project->id, $data->toArray());

        return $this->success(
            new ProjectResource($project),
            'PUT',
            'Project registered successfully',
            Response::HTTP_OK,
        );
    }

    public function destroy(Project $project)
    {
        $this->projectService->delete($project->id);

        return $this->success(
            [],
            'GET',
            'Project deleted successfully',
            Response::HTTP_OK,
        );
    }
}
