<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\MateriController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboardadmin');
    })->name('admin.dashboard');
    Route::get('/dataadopter', [AdopterController::class, 'index'])->name('admin.adopter.index');
    Route::get('/dataadopter/create', [AdopterController::class, 'create'])->name('admin.adopter.create');
    Route::post('/dataadopter', [AdopterController::class, 'store'])->name('admin.adopter.store');
    Route::get('/dataadopter/{id}/edit', [AdopterController::class, 'edit'])->name('admin.adopter.edit');
    Route::put('/dataadopter/{id}', [AdopterController::class, 'update'])->name('admin.adopter.update');
    Route::delete('/dataadopter/{id}', [AdopterController::class, 'destroy'])->name('admin.adopter.destroy');
    Route::get('/materi', [MateriController::class, 'index'])->name('admin.materi.index');
    Route::get('/materi/create', [MateriController::class, 'create'])->name('admin.materi.create');
    Route::post('/materi', [MateriController::class, 'store'])->name('admin.materi.store');
    Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('admin.materi.edit');
    Route::put('/materi/{id}', [MateriController::class, 'update'])->name('admin.materi.update');
    Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('admin.materi.destroy');

});

Route::middleware([RoleMiddleware::class . ':adopter'])->group(function () {
    Route::get('/adopter', function () {
        return view('adopter');
    })->name('adopter.dashboard');
});
