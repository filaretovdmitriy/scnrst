<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use App\Http\Resources\ScriptResource;
use App\Services\ScriptService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class ScriptController extends Controller
{


    public function show(ScriptService $scriptService, int $id): ScriptResource|JsonResponse
    {
        $script = $scriptService->getById($id);
        if (!$script) {
            return ApiResponse::error('Not found', 404);
        }

        return ApiResponse::success(new ScriptResource($scriptService));
    }

    public function store(StoreScriptRequest $request, ScriptService $scriptService): JsonResponse
    {
        $script = $scriptService->create($request->validated());

        return ApiResponse::success(new ScriptResource($script));
    }

    public function update(
        UpdateScriptRequest $request,
        ScriptService $scriptService,
        int $id
    ): ScriptResource|JsonResponse {
        $script = $scriptService->update($id, $request->validated());

        if (!$script) {
            return ApiResponse::error('Not found', 404);
        }

        return ApiResponse::success(new ScriptResource($scriptService));
    }

    public function destroy(ScriptService $scriptService, int $id): JsonResponse
    {
        $deleted = $scriptService->delete($id);

        if (!$deleted) {
            return ApiResponse::error('Not found', 404);
        }
        return ApiResponse::success(new ScriptResource($scriptService));
    }
}
