<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/dashboard', function () {
    return view('dashboard.user');
})->middleware('auth')->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->middleware('auth')->name('admin.dashboard');

require __DIR__.'/auth.php';
