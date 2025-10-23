<?php

namespace App\Http\Controllers\Rewrite;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewriteRequest;
use App\Services\GigaChat;
use Illuminate\Http\JsonResponse;

class RewriteController extends Controller
{
    public function rewrite(RewriteRequest $request, GigaChat\GigaChatService $gigaChatService): JsonResponse
    {
        $result = $gigaChatService->rewriteText($request->validated('text'));

        return response()->json(['data' => ['text' => $result]]);
    }
}
