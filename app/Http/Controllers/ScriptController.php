<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScriptCollection;
use App\Services\ScriptService;
use Illuminate\Http\JsonResponse;


class ScriptController extends Controller
{
    public function index(ScriptService $scriptService)
    {
        $scripts = $scriptService->getAll();
        return new ScriptCollection($scripts);
    }
}
