<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use App\Http\Resources\ScriptCollection;
use App\Http\Resources\ScriptResource;
use App\Services\ScriptService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function index(ScriptService $scriptService): ScriptCollection
    {
        $scripts = $scriptService->getAll();

        return new ScriptCollection($scripts);
    }

    public function show(ScriptService $scriptService, int $id): ScriptResource|JsonResponse
    {
        $script = $scriptService->getById($id);
        if (!$script) {
            return response()->json(['message' => 'not found'], 404);
        }

        return new ScriptResource($scriptService);
    }

    public function store(StoreScriptRequest $request, ScriptService $scriptService): ScriptResource
    {
        $script = $scriptService->create($request->validated());

        return new ScriptResource($script);
    }

    public function update(
        UpdateScriptRequest $request,
        ScriptService $scriptService,
        int $id
    ): ScriptResource|JsonResponse {
        $script = $scriptService->update($id, $request->validated());

        if (!$script) {
            return response()->json(['message' => 'Not found', 'result' => 'error'], 404);
        }

        return new ScriptResource($script);
    }

    public function destroy(ScriptService $scriptService, int $id): JsonResponse
    {
        $deleted = $scriptService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['result' => 'success'], 200);
    }
}
