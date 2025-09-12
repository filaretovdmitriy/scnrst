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

    public function getById(int $id): Script
    {
        return Script::find($id);
    }

    public function create(array $data): Script
    {
        return Script::create($data);
    }

    public function update(int $id, array $data): ?Script
    {
        $script = Script::find($id);

        if (!$script) {
            return null;
        }

        $script->update($data);

        return $script;
    }

    public function delete(int $id): bool
    {
        $script = Script::find($id);

        if (!$script) {
            return false;
        }

        return (bool)$script->delete();
    }
}
