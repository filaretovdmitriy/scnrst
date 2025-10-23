<?php

namespace App\Services\Script;

use App\DTOs\ScriptData;
use App\Models\Script;
use Illuminate\Database\Eloquent\Collection;

class ScriptService
{
    public function getAll(): Collection
    {
        return Script::all();
    }

    public function create(ScriptData $data): Script
    {
        return Script::create($data->toArray());
    }

    public function update(Script $script, ScriptData $data): Script
    {
        $script->update($data->toArray());

        return $script;
    }

    public function getByIdOrFail(int $id): Script
    {
        return Script::findOrFail($id);
    }

    public function delete(Script $script): bool
    {
        return $script->delete();
    }

    public function getById(int $id): ?Script
    {
        return Script::find($id);
    }
}
