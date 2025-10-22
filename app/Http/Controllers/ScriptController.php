<?php

namespace App\Http\Controllers;

use App\DTOs\ScriptData;
use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use App\Http\Resources\ScriptCollection;
use App\Http\Resources\ScriptResource;
use App\Models\Script;
use App\Services\ScriptService;

class ScriptController extends Controller
{
    public function __construct(private ScriptService $scriptService) {}

    public function index(): ScriptCollection
    {
        $scripts = $this->scriptService->getAll();

        return new ScriptCollection($scripts);
    }

    public function show(Script $script): ScriptResource
    {
        return new ScriptResource($script);
    }

    public function store(StoreScriptRequest $request): ScriptResource
    {
        $dto = ScriptData::from($request);
        $script = $this->scriptService->create($dto);

        return new ScriptResource($script);
    }

    public function update(
        UpdateScriptRequest $request,
        Script $script
    ): ScriptResource {
        $dto = ScriptData::from($request);

        return new ScriptResource($this->scriptService->update($script, $dto));
    }

    public function destroy(Script $script)
    {
        $this->scriptService->delete($script);

        return response()->noContent();
    }
}
