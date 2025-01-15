<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UserDashboardController;  // Assurez-vous que ce contrôleur existe.
use App\Http\Controllers\AdminDashboardController; // Assurez-vous que ce contrôleur existe.

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Routes pour le profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour le dashboard en fonction du rôle
    Route::middleware(['role:user'])->get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::middleware(['role:admin'])->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

require __DIR__.'/auth.php';
