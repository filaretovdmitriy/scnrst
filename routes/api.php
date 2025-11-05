<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Rewrite\RewriteController;
use App\Http\Controllers\Script\ScriptController;
use Illuminate\Support\Facades\Route;

Route::apiResource('scripts', ScriptController::class);

Route::post('/rewrite', RewriteController::class);

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
