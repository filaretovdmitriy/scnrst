<?php

namespace App\Http\Controllers;

use App\Services\GigaChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RewriteController extends Controller
{
    public function rewrite(Request $request, GigaChatService $gigaChatService): JsonResponse
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $result = $gigaChatService->rewriteText($request->text);


        return response()->json(['text' => $result]);
    }


}
