<?php

use App\Http\Controllers\RewriteController;
use App\Http\Controllers\ScriptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('scripts', ScriptController::class);

Route::post('/rewrite', [RewriteController::class, 'rewrite']);
