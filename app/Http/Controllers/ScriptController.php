<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScriptRequest;
use App\Http\Resources\ScriptCollection;
use App\Http\Resources\ScriptResource;
use App\Services\ScriptService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ScriptController extends Controller
{
    public function index(ScriptService $scriptService): ScriptCollection
    {
        $scripts = $scriptService->getAll();

        return new ScriptCollection($scripts);
    }

    public function show(ScriptService $scriptService, int $id): ScriptResource|JsonResource
    {
        $script = $scriptService->getById($id);
        if (!$script) {
            return response()->json(['message' => 'not found'], 404);
        }

        return new ScriptResource($scriptService);
    }

    public function store(Request $request, ScriptService $scriptService): ScriptResource
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $script = $scriptService->create($validated);

        return new ScriptResource($script);
    }

    public function update(
        UpdateScriptRequest $request,
        ScriptService $scriptService,
        int $id
    ): ScriptResource|JsonResource {
        $script = $scriptService->update($id, $request->validated());

        if (!$script) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return new ScriptResource($script);
    }

    public function destroy(ScriptService $scriptService, int $id): JsonResponse
    {
        $deleted = $scriptService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(null, 200);
    }
}
