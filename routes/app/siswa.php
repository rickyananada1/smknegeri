<?php

use Illuminate\Support\Facades\Route;

Route::group(['domain' => ''], function() {
    Route::group(['middleware' => ['auth:siswa','verified']], function () {
        Route::redirect('/', 'dashboard', 301);
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});