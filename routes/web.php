<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;

// Homepage
Route::get('/', function () {
    return view('welcome');
});




// Registration Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->middleware('guest')
    ->name('register');
    
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register.submit');

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');  // This is the missing route name
    
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.submit');

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard Route
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

// User Profile Routes
Route::get('/profile', [AuthController::class, 'showProfile'])
    ->middleware('auth')
    ->name('profile');

Route::put('/profile', [AuthController::class, 'updateProfile'])
    ->middleware('auth')
    ->name('profile.update');

// Member Registration
Route::get('/members', [MemberController::class, 'create']); // Show the member form
Route::post('/members', [MemberController::class, 'store'])->name('members.store'); // Save the form
