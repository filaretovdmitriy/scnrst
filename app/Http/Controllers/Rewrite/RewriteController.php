<?php

namespace App\Http\Controllers\Rewrite;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewriteRequest;
use App\Services\Rewrite;
use Illuminate\Http\JsonResponse;

class RewriteController extends Controller
{
    public function __construct(private Rewrite\RewriteServiceInterface $rewriteService)
    {

    }

    public function rewrite(RewriteRequest $request): JsonResponse
    {
        $result = $this->rewriteService->rewriteText($request->validated('text'));

        return response()->json(['data' => ['text' => $result]]);
    }
}
