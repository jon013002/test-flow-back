<?php

namespace App\Http\Controllers;

use App\DTOs\ModuleData;

use App\Models\Module;

use App\Http\Requests\Modules\StoreModuleRequest;
use App\Http\Requests\Modules\UpdateModuleRequest;

use App\Http\Resources\ModuleResource;

use App\Services\ModuleService;
use App\Traits\HTTPResponses;
use Illuminate\Http\Response;

class ModuleController extends Controller
{
    use HTTPResponses;

    public function __construct(
        protected ModuleService $moduleService
    ) {}

    public function index()
    {
        // 🚧 Work in on
    }

    public function store(StoreModuleRequest $request)
    {
        $data = ModuleData::fromStoreRequest($request);
        $module = $this->moduleService->create($data->toArray());

        return $this->success(
            new ModuleResource($module),
            'POST',
            'Module registered successfully',
            Response::HTTP_CREATED,
        );
    }

    public function show(Module $module)
    {
        $module = $this->moduleService->show($module->id);

        return $this->success(
            new ModuleResource($module),
            'GET',
            'Module retrieved successfully',
            Response::HTTP_OK,
        );
    }

    public function update(UpdateModuleRequest $request, Module $module)
    {
        $data = ModuleData::fromUpdateRequest($request);
        $module = $this->moduleService->update($module->id, $data->toArray());

        return $this->success(
            new ModuleResource($module),
            'PUT',
            'Module registered successfully',
            Response::HTTP_OK,
        );
    }

    public function destroy(Module $module)
    {
        $this->moduleService->delete($module->id);

        return $this->success(
            [],
            'GET',
            'Module deleted successfully',
            Response::HTTP_OK,
        );
    }
}
