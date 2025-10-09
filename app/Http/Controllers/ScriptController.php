<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use App\Http\Resources\ScriptResource;
use App\Models\Script;
use App\Services\ScriptService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class ScriptController extends Controller
{

    public function __construct(private ScriptService $scriptService)
    {
    }

    public function index(): JsonResponse
    {
        $scripts = $this->scriptService->getAll();

        return ApiResponse::success(ScriptResource::collection($scripts));
    }

    public function show(Script $script): ScriptResource|JsonResponse
    {
        return new ScriptResource($script);
    }

    public function store(StoreScriptRequest $request): ScriptResource|JsonResponse
    {
        $script = $this->scriptService->create($request->validated());

        return new ScriptResource($script);
    }

    public function update(
        UpdateScriptRequest $request,
        Script              $script
    ): ScriptResource|JsonResponse
    {
        $this->scriptService->update($script->id, $request->validated());

        return ApiResponse::success(new ScriptResource($this->scriptService));
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->scriptService->delete($id);

        return ApiResponse::success(new ScriptResource($this->scriptService));
    }
}
