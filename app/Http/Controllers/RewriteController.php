<?php

namespace App\Http\Controllers;

use App\DTOs\RewriteData;
use App\Http\Requests\StoreRewriteRequest;
use App\Services\GigaChat;
use Illuminate\Http\JsonResponse;

class RewriteController extends Controller
{
    public function rewrite(StoreRewriteRequest $request, GigaChat\GigaChatService $gigaChatService): JsonResponse
    {
        $result = $gigaChatService->rewriteText(RewriteData::from($request));

        return response()->json(['data' => ['text' => $result]]);
    }
}
