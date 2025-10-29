<?php

namespace App\Http\Controllers\Rewrite;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewriteRequest;
use App\Services\Ai\AiService;
use Illuminate\Http\JsonResponse;

class RewriteController extends Controller
{
    public function __construct(private AiService $aiService)
    {
    }

    public function __invoke(RewriteRequest $request): JsonResponse
    {
        $result = $this->aiService->rewriteText($request->validated('text'));

        return response()->json(['data' => ['text' => $result]]);
    }
}
