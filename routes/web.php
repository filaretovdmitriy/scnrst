<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyTestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trampampam', [MyTestController::class, 'index']);
