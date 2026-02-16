<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

Route::get('/students', [StudentController::class, 'index']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/students', [StudentController::class, 'index'])->middleware('auth');
