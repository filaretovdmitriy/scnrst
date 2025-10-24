<?php

namespace App\Http\Controllers\Rewrite;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewriteRequest;
use App\Services\Ai;
use App\Services\Ai\AiService;
use App\Services\Script\ScriptService;
use Illuminate\Http\JsonResponse;

class RewriteController extends Controller
{
    public function __construct(private AiService $aiService)
    {

    }

    public function rewrite(RewriteRequest $request): JsonResponse
    {
        $result = $this->aiService->rewriteText($request->validated('text'));

        return response()->json(['data' => ['text' => $result]]);
    }
}
