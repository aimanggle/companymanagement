<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;

// Login Routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout Route (Authenticated only)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (Authenticated only)
Route::middleware(['auth'])->group(function () {
    // Company Resource Routes
    Route::resource('companies', CompanyController::class);
});