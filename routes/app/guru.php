<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\DashboardController;

Route::group(['domain' => ''], function() {
    Route::redirect('/', 'dashboard', 301);
    Route::prefix('guru')->name('guru.')->group(function() {
        Route::redirect('/', 'dashboard', 301);
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');
    });
});