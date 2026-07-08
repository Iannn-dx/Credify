<?php

use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\User\CredentialController;
use App\Http\Controllers\User\ProfileController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.user');
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('credentials', CredentialController::class);

    Route::resource('requests', RequestController::class);
    Route::resource('verification', VerificationController::class);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';
