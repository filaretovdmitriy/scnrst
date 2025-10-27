<?php

use App\Http\Controllers\Rewrite\RewriteController;
use App\Http\Controllers\Script\ScriptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('scripts', ScriptController::class);

Route::post('/rewrite', RewriteController::class);
