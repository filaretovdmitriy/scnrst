<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use App\Http\Resources\ScriptResource;
use App\Models\Script;
use App\Services\ScriptService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScriptController extends Controller
{
    public function __construct(private ScriptService $scriptService) {}

    public function index(): AnonymousResourceCollection
    {
        $scripts = $this->scriptService->getAll();

        return ScriptResource::collection($scripts);
    }

    public function show(Script $script): ScriptResource
    {
        return new ScriptResource($script);
    }

    public function store(StoreScriptRequest $request): ScriptResource
    {
        $script = $this->scriptService->create($request->validated());

        return new ScriptResource($script);
    }

    public function update(
        UpdateScriptRequest $request,
        Script $script
    ): ScriptResource {
        $this->scriptService->update($script->id, $request->validated());

        return new ScriptResource($this->scriptService);
    }

    public function destroy(int $id): ScriptResource
    {
        $deleted = $this->scriptService->delete($id);

        return new ScriptResource($this->scriptService);
    }
}
