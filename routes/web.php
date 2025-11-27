<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\MateriController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\KucingController;
use App\Http\Controllers\AdoptController;
use App\Http\Controllers\ProviderAdoptController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// 👉 Landing page (halaman awal)
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// 👉 Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {

    Route::get('/admin', function () {
        return view('dashboardadmin');
    })->name('admin.dashboard');

    // CRUD Adopter
    Route::get('/dataadopter', [AdopterController::class, 'index'])->name('admin.adopter.index');
    Route::get('/dataadopter/create', [AdopterController::class, 'create'])->name('admin.adopter.create');
    Route::post('/dataadopter', [AdopterController::class, 'store'])->name('admin.adopter.store');
    Route::get('/admin/adopter/{id}/json', [AdopterController::class, 'getJson'])->name('admin.adopter.json');
    Route::put('/admin/adopter/{id}', [AdopterController::class, 'update'])->name('admin.adopter.update');
    Route::delete('/admin/adopter/{id}', [AdopterController::class, 'destroy'])->name('admin.adopter.destroy');

    // CRUD Materi
    Route::get('/materi', [MateriController::class, 'index'])->name('admin.materi.index');
    Route::get('/materi/create', [MateriController::class, 'create'])->name('admin.materi.create');
    Route::post('/materi', [MateriController::class, 'store'])->name('admin.materi.store');
    Route::get('/admin/materi/{id}/json', [MateriController::class, 'getJson'])->name('admin.materi.json');
    Route::put('/admin/materi/{id}', [MateriController::class, 'update'])->name('admin.materi.update');
    Route::delete('/admin/materi/{id}', [MateriController::class, 'destroy'])->name('admin.materi.destroy');
});



/*
|--------------------------------------------------------------------------
| ADOPTER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware([RoleMiddleware::class . ':adopter'])->group(function () {

    Route::get('/adopter', function () {
        return view('dashboardadopter');
    })->name('adopter.dashboard');

    Route::get('/adopter/pilih', [AdoptController::class, 'pilihKucing'])
        ->name('adopter.pilih');

    Route::get('/adopter/quiz/{kucing_id}', [AdoptController::class, 'mulaiQuiz'])
        ->name('adopter.quiz');

    Route::post('/adopter/quiz/{kucing_id}', [AdoptController::class, 'submitQuiz'])
        ->name('adopter.quiz.submit');

    Route::get('/adopter/status', [AdoptController::class, 'status'])
        ->name('adopter.status');
});



/*
|--------------------------------------------------------------------------
| PROVIDER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware([RoleMiddleware::class . ':provider'])->group(function () {

    Route::get('/provider', function () {
        return view('dashboardprovider');
    })->name('provider.dashboard');

    Route::get('/provider/kucing', [KucingController::class, 'index'])->name('provider.kucing.index');
    Route::post('/provider/kucing', [KucingController::class, 'store'])->name('provider.kucing.store');
    Route::put('/provider/kucing/{id}', [KucingController::class, 'update'])->name('provider.kucing.update');
    Route::delete('/provider/kucing/{id}', [KucingController::class, 'destroy'])->name('provider.kucing.destroy');

    Route::get('/provider/adoption', [ProviderAdoptController::class, 'index'])->name('provider.adoption.list');
    Route::get('/provider/adoption/{id}', [ProviderAdoptController::class, 'review'])->name('provider.adoption.review');
    Route::post('/provider/adoption/{id}/nilai', [ProviderAdoptController::class, 'nilai'])->name('provider.nilai');
});
