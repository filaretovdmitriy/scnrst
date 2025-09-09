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
}
