<?php

use App\Http\Controllers\Admin\CredentialController as AdminCredentialController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VerificationController as AdminVerificationController;
use App\Http\Controllers\Admin\VerificationRequestController as AdminVerificationRequestController;
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\User\CredentialController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');

    Route::get('/requests', [AdminVerificationRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{verificationRequest}', [AdminVerificationRequestController::class, 'show'])->name('requests.show');

    Route::get('/credentials', [AdminCredentialController::class, 'index'])->name('credentials.index');
    Route::get('/verifications', [AdminVerificationController::class, 'index'])->name('verifications.index');
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
