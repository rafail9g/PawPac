<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\MateriController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\KucingController;
use App\Http\Controllers\AdoptController;
use App\Http\Controllers\ProviderAdoptController;
use App\Http\Controllers\HistoryAdoptController;
use App\Http\Controllers\AdoptionAdminController;
use App\Http\Controllers\QuizAdminController;

Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN ROUTES
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboardadmin');
    })->name('admin.dashboard');

    // Adopter CRUD
    Route::get('/dataadopter', [AdopterController::class, 'index'])->name('admin.adopter.index');
    Route::get('/dataadopter/create', [AdopterController::class, 'create'])->name('admin.adopter.create');
    Route::post('/dataadopter', [AdopterController::class, 'store'])->name('admin.adopter.store');
    Route::get('/admin/adopter/{id}/json', [AdopterController::class, 'getJson'])->name('admin.adopter.json');
    Route::put('/admin/adopter/{id}', [AdopterController::class, 'update'])->name('admin.adopter.update');
    Route::delete('/admin/adopter/{id}', [AdopterController::class, 'destroy'])->name('admin.adopter.destroy');

    // Materi CRUD
    Route::get('/materi', [MateriController::class, 'index'])->name('admin.materi.index');
    Route::get('/materi/create', [MateriController::class, 'create'])->name('admin.materi.create');
    Route::post('/materi', [MateriController::class, 'store'])->name('admin.materi.store');
    Route::get('/admin/materi/{id}/json', [MateriController::class, 'getJson'])->name('admin.materi.json');
    Route::put('/admin/materi/{id}', [MateriController::class, 'update'])->name('admin.materi.update');
    Route::delete('/admin/materi/{id}', [MateriController::class, 'destroy'])->name('admin.materi.destroy');

    // History
    Route::get('/history', [HistoryAdoptController::class, 'index'])->name('admin.history.index');
    Route::get('/admin/history/{id}/json', [HistoryAdoptController::class, 'getJson'])->name('admin.history.json');
    Route::put('/admin/history/{id}', [HistoryAdoptController::class, 'update'])->name('admin.history.update');
    Route::delete('/admin/history/{id}', [HistoryAdoptController::class, 'destroy'])->name('admin.history.destroy');

    // Adopsi
    Route::get('/adopsi', [AdoptionAdminController::class, 'index'])->name('admin.adopsi.index');
    Route::get('/admin/adopsi/{id}/json', [AdoptionAdminController::class, 'getJson'])->name('admin.adopsi.json');
    Route::put('/admin/adopsi/{id}', [AdoptionAdminController::class, 'update'])->name('admin.adopsi.update');
    Route::delete('/admin/adopsi/{id}', [AdoptionAdminController::class, 'destroy'])->name('admin.adopsi.destroy');
    Route::post('/admin/adopsi/{id}/status', [AdoptionAdminController::class, 'updateStatus'])->name('admin.adopsi.status');
    Route::get('/admin/adopsi/adopters', [AdoptionAdminController::class, 'getAdopters']);
    Route::get('/admin/adopsi/kucing', [AdoptionAdminController::class, 'getKucing']);

    // QUIZ CRUD - FIXED ROUTES
    Route::get('/quiz', [QuizAdminController::class, 'index'])->name('admin.quiz.index');
    Route::post('/quiz', [QuizAdminController::class, 'store'])->name('admin.quiz.store');
    Route::get('/admin/quiz/{id}/json', [QuizAdminController::class, 'getJson'])->name('admin.quiz.json');
    Route::put('/admin/quiz/{id}', [QuizAdminController::class, 'update'])->name('admin.quiz.update');
    Route::delete('/admin/quiz/{id}', [QuizAdminController::class, 'destroy'])->name('admin.quiz.destroy');
});

// ADOPTER ROUTES
Route::middleware([RoleMiddleware::class . ':adopter'])->group(function () {
    Route::get('/adopter', function () {
        return view('dashboardadopter');
    })->name('adopter.dashboard');

    Route::get('/adopter/pilih', [AdoptController::class, 'pilihKucing'])->name('adopter.pilih');
    Route::get('/adopter/quiz/{kucing_id}', [AdoptController::class, 'mulaiQuiz'])->name('adopter.quiz');
    Route::post('/adopter/quiz/{kucing_id}', [AdoptController::class, 'submitQuiz'])->name('adopter.quiz.submit');
    Route::get('/adopter/status', [AdoptController::class, 'status'])->name('adopter.status');

    Route::get('/adopter/materi', function () {
        $materi = \App\Models\Materi::all();
        return view('adoptermateri', compact('materi'));
    })->name('adopter.materi');
});

// PROVIDER ROUTES
Route::middleware([RoleMiddleware::class . ':provider'])->group(function () {
    Route::get('/provider', function () {
        return view('dashboardprovider');
    })->name('provider.dashboard');

    // Kucing CRUD
    Route::get('/provider/kucing', [KucingController::class, 'index'])->name('provider.kucing.index');
    Route::post('/provider/kucing', [KucingController::class, 'store'])->name('provider.kucing.store');
    Route::put('/provider/kucing/{id}', [KucingController::class, 'update'])->name('provider.kucing.update');
    Route::delete('/provider/kucing/{id}', [KucingController::class, 'destroy'])->name('provider.kucing.destroy');

    // Adoption Review
    Route::get('/provider/adoption', [ProviderAdoptController::class, 'index'])->name('provider.adoption.list');
    Route::get('/provider/adoption/{id}', [ProviderAdoptController::class, 'review'])->name('provider.adoption.review');
    Route::post('/provider/adoption/{id}/nilai', [ProviderAdoptController::class, 'nilai'])->name('provider.nilai');
});
