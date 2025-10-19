<?php

namespace App\Http\Controllers;

use App\Services\GigaChatService;
use Illuminate\Http\Request;

class RewriteController extends Controller
{
    public function rewrite(Request $request, GigaChatService $gigaChatService)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $resutl = $gigaChatService->rewriteText($request->text);

        return response()->json(['text' => $resutl]);
    }
}
