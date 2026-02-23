<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceApiController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [RegisterController::class,'show'])->name('register');
Route::post('/register', [RegisterController::class,'store']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/api/user', [UserApiController::class, 'current']);
    Route::get('/api/subjects', [AttendanceApiController::class, 'subjects']);
    Route::get('/api/classes', [AttendanceApiController::class, 'classes']);
    Route::get('/api/students-by-class', [AttendanceApiController::class, 'studentsByClass']);
    Route::post('/api/save-attendance', [AttendanceApiController::class, 'save']);
});
