<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ScriptService;

class ScriptController extends Controller
{
    public function index(ScriptService $scriptService): JsonResponse
    {
        $scripts = $scriptService->getAll();
        return response()->json($scripts);
    }
}
