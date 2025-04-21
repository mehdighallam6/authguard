<?php

use App\Http\Controllers\AdminUser\AdminTagController;
use App\Http\Controllers\StandardUser\StandardTagController;
use App\Http\Controllers\AdminUser\AdminAuthenticatorController;
use App\Http\Controllers\StandardUser\StandardAuthenticatorController;
use App\Http\Controllers\AdminUser\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('atags', AdminTagController::class)->parameters(['atags' => 'tag']);
        Route::resource('aauthenticators', AdminAuthenticatorController::class)->parameters(['aauthenticators' => 'authenticator']);
        // Logs
        Route::get('view.telescope', [HomeController::class, 'viewTelescope'])->name('view.telescope');
    });

    Route::middleware(['role:standard'])->group(function () {
        Route::resource('stags', StandardTagController::class)->parameters(['stags' => 'tag']);
        Route::resource('sauthenticators', StandardAuthenticatorController::class)->parameters(['sauthenticators' => 'authenticator']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
