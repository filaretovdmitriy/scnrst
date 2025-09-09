<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScriptCollection;
use App\Services\ScriptService;

class ScriptController extends Controller
{
    public function index(ScriptService $scriptService)
    {
        $scripts = $scriptService->getAll();

        return new ScriptCollection($scripts);
    }
}
