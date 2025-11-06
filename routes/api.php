<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Rewrite\RewriteController;
use App\Http\Controllers\Script\ScriptController;
use Illuminate\Support\Facades\Route;

Route::apiResource('scripts', ScriptController::class);

Route::post('/rewrite', RewriteController::class);

Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [UserController::class, 'user'])->middleware('auth:sanctum');
