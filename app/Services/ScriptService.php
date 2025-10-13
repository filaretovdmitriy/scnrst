<?php

namespace App\Services;

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

    public function update(int $id, ScriptData $data): ?Script
    {
        $script = $this->getById($id);

        $script->update($data->toArray());

        return $script;
    }

    public function getById(int $id): ?Script
    {
        return Script::find($id) ?: null;
    }

    public function getByIdOrFail(int $id): ?Script
    {
        return Script::findOrFail($id) ?: null;
    }

    public function delete(int $id): bool
    {
        $script = $this->getById($id);

        return $script->delete();
    }
}
