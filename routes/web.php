<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/students');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // admin + user can view the list
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');

    // admin only
    Route::middleware(AdminOnly::class)->group(function () {
        Route::resource('students', StudentController::class)->except('index');
        Route::resource('departments', DepartmentController::class)->except('show');
    });
});
