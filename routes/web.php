<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;


Route::get('/', function () {
    return view('home');
});


Route::view('/about', 'about');

// Landing Page
Route::get('/', [AuthController::class, 'landing'])->name('landing');

// Auth Pages
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Protected Page
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');

// Forgot password
Route::get('/forgot-password', [PasswordController::class, 'showForgotForm']);
Route::post('/forgot-password', [PasswordController::class, 'sendResetLink']);

// Reset password
Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm']);
Route::post('/reset-password', [PasswordController::class, 'resetPassword']);