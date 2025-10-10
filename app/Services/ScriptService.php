<?php

namespace App\Services;

use App\Models\Script;
use Illuminate\Database\Eloquent\Collection;

class ScriptService
{
    public function getAll(): Collection
    {
        return Script::all();
    }

    public function create(array $data): Script
    {
        return Script::create($data);
    }

    public function update(int $id, array $data): ?Script
    {
        $script = $this->getById($id);

        $script->update($data);

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
