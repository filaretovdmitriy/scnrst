<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json(['result' => 'success', 'data' => $data], $code);
    }

    public static function error(string $message, int $code = 200): JsonResponse
    {
        return response()->json(['result' => 'error', 'message' => $message], $code);
    }
}
