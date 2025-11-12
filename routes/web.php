<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdopterController;
use App\Http\Middleware\RoleMiddleware;

// === AUTH ===
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// === ADMIN AREA ===
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboardadmin');
    })->name('admin.dashboard'); // kasih nama biar rapi

    // semua route data adopter hanya bisa diakses admin
    Route::get('/dataadopter', [AdopterController::class, 'index'])->name('admin.adopter.index');
    Route::get('/dataadopter/create', [AdopterController::class, 'create'])->name('admin.adopter.create');
    Route::post('/dataadopter', [AdopterController::class, 'store'])->name('admin.adopter.store');
    Route::get('/dataadopter/{id}/edit', [AdopterController::class, 'edit'])->name('admin.adopter.edit');
    Route::put('/dataadopter/{id}', [AdopterController::class, 'update'])->name('admin.adopter.update');
    Route::delete('/dataadopter/{id}', [AdopterController::class, 'destroy'])->name('admin.adopter.destroy');
});

// === ADOPTER AREA ===
Route::middleware([RoleMiddleware::class . ':adopter'])->group(function () {
    Route::get('/adopter', function () {
        return view('adopter');
    })->name('adopter.dashboard');
});
